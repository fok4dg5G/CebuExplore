<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

use App\Http\Controllers;
use App\Models\Category;
use App\Models\Task;
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tourist-spot', [App\Http\Controllers\TaskController::class, 'touristSpot'])->name('tourist-spot');

Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');

// 新しい投稿の作成
Route::get('/tourist-spot/create', [App\Http\Controllers\TaskController::class, 'create'])->name('posts.create');
//新規投稿保存
Route::post('/store', [App\Http\Controllers\TaskController::class, 'store'])->name('store');
