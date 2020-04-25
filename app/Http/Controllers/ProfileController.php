<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateBio(Request $request)
    {
        $userID = $request->user()->id;
        User::where('id', $userID)
            ->update([
                'bio' => $request->bio,
            ]);
        return $request->user();
    }
}
