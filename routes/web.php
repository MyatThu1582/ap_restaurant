<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DishesController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'confirm' => false,  // Password Confirmation Routes...
  ]);

Route::get('/home', [App\Http\Controllers\OrderController::class, 'index'])->name('home');
Route::resource('dish', DishesController::class);
