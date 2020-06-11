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
| Recipes
|--------------------------------------------------------------------------
 */

// Get a specific user's recipes
Route::get('/recipes/{username}', 'RecipeController@getUserRecipes')->name('getUserRecipes');

// Get a specific recipe
Route::get('/recipes/{id}', 'RecipeController@getUserRecipes')->name('getRecipe');

// Create recipe
Route::middleware("auth:api")->post('/createrecipe', 'RecipeController@create')->name('createrecipe');

// Update user recipe

// Delete user recipe
