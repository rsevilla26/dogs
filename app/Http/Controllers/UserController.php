<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('likedDogs.dog')->get();

        return Inertia::render('Users', compact('users'));
    }
}
