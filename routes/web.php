<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDogController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/dogs/{dog}/like', [DogsController::class, 'like']);
    Route::delete('/dogs/{dog}/unlike', [DogsController::class, 'unlike']);
    Route::get('/users', [UserDogController::class, 'index'])->name('users.index');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
