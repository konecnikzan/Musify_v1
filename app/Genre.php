<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'genre_name'
    ];

    public function musicTastes()
    {
        return $this->belongsToMany(MusicTaste::class, 'genre__music_tastes');
    }
}
