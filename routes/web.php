<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

Route::post('/profile/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');

Route::put('/profile/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

Route::get('/touristspot', [App\Http\Controllers\TouristSpotController::class, 'index'])->name('touristspot');
Route::post('/touristspot/store', [App\Http\Controllers\TouristSpotController::class, 'store'])->name('tourist.store');
Route::get('/tourist/{id}', [App\Http\Controllers\TouristSpotController::class, 'show'])->name('tourist.show');
Route::post('/tourist/{postId}/comment', [App\Http\Controllers\TouristSpotController::class, 'storeComment'])->name('tourist.comments.store');

