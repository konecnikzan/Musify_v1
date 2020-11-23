<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'spotify_id', 'spotify_token', 'spotify_refresh_token', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function musicTastes()
    {
    	return $this->hasMany('App\MusicTaste');
    }

    public function messages()
    {
    	return $this->hasMany('App\Message');
    }

    public function usersimilarities()
    {
    	return $this->hasMany('App\UserSimilarity');
    }
}
