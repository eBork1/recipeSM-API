<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        "title", "user_id", "difficulty", "ingredients", "body", "image_links",
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
