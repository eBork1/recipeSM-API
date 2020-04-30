<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\User;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function getUserRecipes($username)
    {
        $id = User::where('name', $username)->first()->id;
        $recipes = Recipe::where('user_id', $id)->get();

        return response()->json($recipes);
    }

    public function create(Request $data)
    {
        Recipe::create([
            'title' => $data->title,
            'user_id' => $data->user()->id,
            'difficulty' => $data->difficulty,
            'ingredients' => $data->ingredients,
            'body' => $data->body,
            'image_links' => $data->image_links,
        ]);

        return response()->json('Recipe Created!');
    }
}
