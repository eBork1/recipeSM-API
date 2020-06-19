<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        "user_id", "followed_user",
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
