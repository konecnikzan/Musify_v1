<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

use App\User;
use App\Genre;
use App\Artist;
use App\MusicTaste;
use App\Genre_MusicTaste;
use Str;
use Hash;
use DB;

class ProfileController extends Controller
{
    public function show_profile($id) {
        $data = array();

        $avatar = DB::table('users')->select('avatar')->where(['id' => $id])->get();
        $name = DB::table('users')->select('name')->where(['id' => $id])->get();

        $favorite_genres = DB::table('genres')
                ->select('genres.genre_name')
                ->selectRaw('count(genres.genre_name) AS count_genres')
                ->join("genre__music_tastes", "genres.id", "=", "genre__music_tastes.genre_id")
                ->join("music_tastes", "music_tastes.id", "=", "genre__music_tastes.music_taste_id")
                ->join("users", "users.id", "=", "music_tastes.user_id")
                ->where(['users.id' => $id])->groupBy("genres.genre_name")->orderBy('count_genres', 'DESC')->limit(12)->get();
        $favorite_artists = DB::table('music_tastes')
                ->select('artists.artist_name', 'music_tastes.image')
                ->join("artists", "music_tastes.artist_id", "=", "artists.id")
                ->join("users", "users.id", "=", "music_tastes.user_id")
                ->where(['users.id' => $id])->get();  

        $refresh_token = DB::table('users')->select('spotify_refresh_token')->where(['id' => $id])->get();
        $encode = base64_encode("179b7ea035344501a7d47003eaf5ed06:949bb08b938c4b9c95dfb79d234e556c");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=refresh_token&refresh_token=" . $refresh_token[0]->spotify_refresh_token);

        $headers = array();
        $headers[] = 'Authorization: Basic ' . $encode;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $access_token = json_decode($result)->access_token;


        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $access_token
        ])->get('https://api.spotify.com/v1/me/top/tracks?time_range=medium_term&limit=15&offset=0'); 

        $response = json_decode($request->getBody());
        $favorite_music = $response->items;

        array_push($data, $avatar, $name, $favorite_genres, $favorite_artists, $favorite_music);

        //dd($data);
        return view('profile')->with(['data' => $data]);
    }
}
