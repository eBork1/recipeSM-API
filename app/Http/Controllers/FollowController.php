<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow(Request $data)
    {
        $followed_user_id = User::where('name', $data->followed_user)->first()->id;

        Follow::create([
            "user_id" => $data->user()->id,
            "followed_user" => $followed_user_id,
        ]);
        return response("success");
    }

    // public function unfollow()
    // {
    //     //
    // }

    // public function getFollowerCount(Request $data)
    // {

    // }
}
