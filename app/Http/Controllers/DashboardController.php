<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $dogs = Dog::all();
        $liked = auth()->user()->likedDogs()->pluck('dog_id')->toArray();

        return Inertia::render('Dashboard', [
            'dogs' => $dogs,
            'liked' => $liked,
        ]);
    }
}
