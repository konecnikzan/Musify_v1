<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSimilarity extends Model
{
    protected $fillable = [
        'user_id', 'similarities'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
