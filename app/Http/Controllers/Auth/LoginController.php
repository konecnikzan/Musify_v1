<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\User;
use App\Genre;
use App\Artist;
use App\MusicTaste;
use App\Genre_MusicTaste;
use App\UserSimilarity;
use Str;
use Hash;
use DB;
use App\CustomClass\Similarity;
use Session;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->scopes('user-top-read', 'user-read-email')->redirect();
    }

    public function handleProviderCallback($provider) {
        Auth::logout();
        $user = Socialite::driver($provider)->user();

        $token = $user->token;
        $refresh_token = $user->refreshToken;
        $name = $user->name;
        $id = $user->id;
        $profile_pic = $user->avatar;

        if($profile_pic == null) {
            $profile_pic = "https://kansai-resilience-forum.jp/wp-content/uploads/2019/02/IAFOR-Blank-Avatar-Image-1.jpg";
        }

        //USER CREATE
        $user = User::firstOrCreate([
            'spotify_id' => $id
        ], [
            'name' => $name,
            'spotify_id' => $id,
            'spotify_token' => $token,
            'spotify_refresh_token' => $refresh_token,
            'avatar' => $profile_pic,
            'password' => bcrypt('5yr20mfds03223')
        ]);

        if($user->wasRecentlyCreated == false) {
            DB::table('users')->where('spotify_id', $id)->update(['spotify_token' => $token, 'spotify_refresh_token' => $refresh_token, 'avatar' => $profile_pic]);
        }

        
        //MUSICTASTE API
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])->get('https://api.spotify.com/v1/me/top/artists?time_range=medium_term&limit=10&offset=0'); 

        $response = json_decode($request->getBody());

        $data = $response->items;

        $getUserId = DB::table('users')->select('id')->where('spotify_id', '=', $id)->get();
        $getFirstMusicTasteId = DB::table('music_tastes')->select('id')->where('user_id', '=', $getUserId[0]->id)->get();
        

        //VNOS MUSICTASTE V BAZO
        /*for ($i = 0; $i < count($data); $i++) {
            $artist_name = $data[$i]->name;
            $artist_id = $data[$i]->id;

            Artist::firstOrCreate([
                'artist_id' => $artist_id
            ], [
                'artist_name' => $artist_name,
                'artist_id' => $artist_id          
            ]);

            $image = $data[$i]->images[0]->url;
            $image_width = $data[$i]->images[0]->width;
            $image_height = $data[$i]->images[0]->height;          

            $getArtistId = DB::table('artists')->select('id')->where('artist_id', '=', $artist_id)->get();

            if($getFirstMusicTasteId->isEmpty()) {        
                DB::table('music_tastes')->insert(
                    array('user_id' => $getUserId[0]->id,'artist_id' => $getArtistId[0]->id, 'image' => $image,'image_width' => $image_width,'image_height' => $image_height)
                );
            } else {
               $updateID = $getFirstMusicTasteId[0]->id + $i;
               DB::update('UPDATE music_tastes SET user_id=?, artist_id=?, image=?, image_width=?, image_height=? WHERE id=?', [$getUserId[0]->id, $getArtistId[0]->id, $image, $image_width, $image_height, $updateID]);
            }    

            $genreIdArray = array();

            for ($j = 0; $j < count($data[$i]->genres); $j++) {
                $genreName = $data[$i]->genres[$j];

                Genre::firstOrCreate([
                    'genre_name' => $genreName
                ], [
                    'genre_name' => $genreName          
                ]);

                $getGenreId = DB::table('genres')->select('id')->where('genre_name', $genreName)->get();

                array_push($genreIdArray, $getGenreId[0]->id);
            }

            $getMusicTasteId = DB::table('music_tastes')->select('id')->where(['user_id' => $getUserId[0]->id, 'artist_id' => $getArtistId[0]->id])->get();
            $musicTasteAttach = MusicTaste::find($getMusicTasteId[0]->id);
            $musicTasteAttach->genres()->detach();	

            for($z = 0; $z < count($genreIdArray); $z++) {
                $musicTasteAttach->genres()->attach($genreIdArray[$z]);
            }
        }*/

        $output = shell_exec('cd python && py script.py '.$getUserId[0]->id.'');
        //echo "<pre>" . $output . "</pre>";
        //dd($output);

        $similarity = UserSimilarity::firstOrCreate([
            'user_id' => $getUserId[0]->id
        ], [
            'user_id' => $getUserId[0]->id,
            'similarities' => $output         
        ]);

        if($similarity->wasRecentlyCreated == false) {
            DB::table('user_similarities')->where('user_id', $getUserId[0]->id)->update(['similarities' => $output]);
        }

        //USER LOGIN
        Auth::login($user);
        return redirect('home');
    } 

    public function returnSimilarityData(){
        //SIMILARITY
        $scriptInputArray = array();
        $tasteRowCount = DB::table('genres')->count();
        $genreTasteArray = array_fill(1, $tasteRowCount, 0);

        $tastes = DB::table('genre__music_tastes')->get();
        $firstUser1 = DB::table('music_tastes')->select('user_id')->where('id', '=', $tastes[0]->music_taste_id)->get();
        $firstUser2 = $firstUser1[0]->user_id;

        $a = 0;
        $len = count($tastes);

        foreach($tastes as $taste) { 
            $getTasteUserId = DB::table('music_tastes')->select('user_id')->where('id', '=', $taste->music_taste_id)->get();
            if($firstUser2 ==  $getTasteUserId[0]->user_id) { 
                $genreTasteArray[$taste->genre_id] = 1;
            } else {
                $scriptInputArray[$firstUser2] = $genreTasteArray;
                $genreTasteArray = array_fill(1, $tasteRowCount, 0);
                $firstUser2 = $getTasteUserId[0]->user_id;
                $genreTasteArray[$taste->genre_id] = 1;
            }
            $a++;
        } 

        $scriptInputArray[$firstUser2] = $genreTasteArray;

        $separateArrays = array();
        $finalArray = array();
        $index = 1;
        foreach ($scriptInputArray as $key => $value) {
            foreach($value as $item) {
                array_push($separateArrays, $key, $index, $item);
                array_push($finalArray, $separateArrays);
                $separateArrays = array();
                $index++;
            }
            $index = 1;
        }

        $str_json = json_encode($finalArray);
        return $str_json;
    }

}
