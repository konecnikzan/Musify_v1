<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'artist_name', 'artist_id'
    ];

    public function musicTastes()
    {
    	return $this->hasMany('App\MusicTaste');
    }
}
