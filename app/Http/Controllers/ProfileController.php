<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateBio(Request $data)
    {
        $userID = $data->user()->id;
        User::where('id', $userID)
            ->update([
                'bio' => $data->bio,
            ]);
    }
}
