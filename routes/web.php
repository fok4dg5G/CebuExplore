<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

Route::post('/profile/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');

Route::put('/profile/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

