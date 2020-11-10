<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicTaste extends Model
{
    protected $fillable = [
        'user_id', 'artist_id', 'image', 'image_width', 'image_height'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function artists()
    {
        return $this->belongsTo('App\Artist');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre__music_tastes');
    }
}
