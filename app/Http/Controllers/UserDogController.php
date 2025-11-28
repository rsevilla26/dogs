<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserDogController extends Controller
{
    public function index()
    {
        $users = User::with('likedDogs')->get();

        return Inertia::render('Users', [
            'users' => $users,
        ]);
    }
}
