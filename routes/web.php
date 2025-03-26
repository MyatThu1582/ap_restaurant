<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\OrderController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [OrderController::class, 'index'])->name('order.form');
Route::post('submit', [OrderController::class, 'submit'])->name('order.submit');

Route::resource('dish', DishesController::class)->middleware('auth');
Route::get('order', [DishesController::class, 'order'])->name('kitchen.order');
Route::get('order/{order}/approve', [DishesController::class, 'approve']);
Route::get('order/{order}/cancel', [DishesController::class, 'cancel']);
Route::get('order/{order}/ready', [DishesController::class, 'ready']);
Route::get('order/{order}/done', [DishesController::class, 'done']);

Route::post('/', [DishesController::class,'search']);


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'confirm' => false,  // Password Confirmation Routes...
  ]);

