<?php

namespace App\Http\Controllers;

use App\Follow;
use App\User;
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

    public function unfollow(Request $data)
    {
        $userToUnfollow = User::where('name', $data->userToUnfollow)->first()->id;
        Follow::where([
            ["user_id", "=", $data->user()->id],
            ["followed_user", "=", $userToUnfollow],
        ])->delete();
        return response("user " . $data->user()->id . "unfollowed user " . $userToUnfollow);
    }

    public function getFollowersInfo($username)
    {
        // Get users ID based on the name passed into the call
        $id = User::where('name', $username)->first()->id;
        // Get user entries where id exists on follows table where followed user == $id
        $users = User::select('users.id', 'name', 'bio')
            ->join('follows', 'follows.user_id', '=', 'users.id')
            ->where('follows.followed_user', $id)
            ->get();
        return response()->json($users);
    }

    // public function getFollowingInfo(Request $data)
    // {
    //     $user = $data->username;

    //     // Get a list of who the user is following
    //     // Returns entire user entry of each person user is following
    // }

}
