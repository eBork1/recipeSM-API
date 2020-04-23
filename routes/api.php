<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
 */

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
 */

Route::post('/login', 'AuthenticationController@login')->name('login');

Route::post('/register', 'AuthenticationController@register')->name('register');

Route::middleware('auth:api')->group(function () {
    Route::get('/logout', 'AuthenticationController@logout')->name('logout');
});

Route::get('/verifyuser', 'AuthenticationController@verify')->name('verify');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| User Profiles
|--------------------------------------------------------------------------
 */

//  Route::get('/getprofile'


