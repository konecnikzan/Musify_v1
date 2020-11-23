<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use App\User;


use App\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $output = shell_exec('cd python && py script.py '.$user->id.'');
        //echo "<pre>" . $output . "</pre>";
        //dd($output);

        $output_split = explode(', ', $output);

        $data = array();

        foreach ($output_split as $item) {
            $sim_user_id = $item;
            //dd($sim_user_id);
            $name = DB::table('users')->select('name')->where(['id' => $sim_user_id])->get();
            $avatar = DB::table('users')->select('avatar')->where(['id' => $sim_user_id])->get();
            $some_genres = DB::table('genres')
                ->select('genres.genre_name')
                ->selectRaw('count(genres.genre_name) AS count_genres')
                ->join("genre__music_tastes", "genres.id", "=", "genre__music_tastes.genre_id")
                ->join("music_tastes", "music_tastes.id", "=", "genre__music_tastes.music_taste_id")
                ->join("users", "users.id", "=", "music_tastes.user_id")
                ->where(['users.id' => $sim_user_id])->groupBy("genres.genre_name")->orderBy('count_genres', 'DESC')->get(); 
            $favorite_artist = DB::table('artists')
                ->join("music_tastes", "music_tastes.artist_id", "=", "artists.id")    
                ->join("users", "users.id", "=", "music_tastes.user_id") 
                ->select('artists.artist_id')
                ->where(['users.id' => $sim_user_id])->first();

            $combined = array();       
            array_push($combined, $sim_user_id, $name, $avatar, $some_genres, $favorite_artist);  
            
            array_push($data, $combined);
        }

        //Session::put('data', $data);

        //$data = (Session::has('data')) ? Session::get('data') : null;
        
        $users = User::where('id', '<>', $user->id)->get();

        //dd($data, $users);

        return view('home')->with(['data' => $data, 'users' => $users]);
    }
}
