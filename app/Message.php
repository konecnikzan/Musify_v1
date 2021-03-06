<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from', 'to', 'message', 'is_read'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
}
