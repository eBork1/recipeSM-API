<?php

use app\User;
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

Route::middleware("auth:api")->post('/updatebio', 'ProfileController@updateBio')->name('updateBio');

/*
|--------------------------------------------------------------------------
| Follows
|--------------------------------------------------------------------------
 */
// Auth Protected
Route::middleware("auth:api")->post('/createfollow', 'FollowController@createFollow')->name('createFollow');
Route::middleware("auth:api")->post('/unfollow', 'FollowController@unfollow')->name('unfollow');
// Public
Route::get('/getfollowers/{username}', "FollowController@getFollowersInfo")->name('getFollowersInfo');
Route::get('/getfollowedusers/{username}', "FollowController@getFollowedUsers")->name('getFollowedUsers');

/*
|--------------------------------------------------------------------------
| Recipes
|--------------------------------------------------------------------------
 */

// Get a specific user's recipes
Route::get('/recipes/{username}', 'RecipeController@getUserRecipes')->name('getUserRecipes');

// Get a specific recipe
Route::get('/recipe/{recipeID}', 'RecipeController@getSingleRecipe')->name('getSingleRecipe');

// Create recipe
Route::middleware("auth:api")->post('/createrecipe', 'RecipeController@create')->name('createrecipe');

// Update user recipe

// Delete user recipe
