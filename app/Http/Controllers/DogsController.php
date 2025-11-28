<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;

class DogsController extends Controller
{
    public function like(Request $request, Dog $dog)
    {
        $user = auth()->user();
        $liked = $user->likedDogs()->pluck('dog_id')->toArray();

        if (in_array($dog->id, $liked)) {
            return back();
        }

        if (count($liked) >= 3) {
            return back()->withErrors(['limit' => 'You can only like up to 3 dogs.']);
        }

        $user->likedDogs()->attach($dog->id);

        return back();
    }

    public function unlike(Request $request, Dog $dog)
    {
        $user = auth()->user();
        $user->likedDogs()->detach($dog->id);

        return back();
    }
}
