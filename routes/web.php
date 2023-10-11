<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\TaskController;

use App\Http\Controllers;
use App\Models\Category;
use App\Models\Task;


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

Route::get('/home', [HomeController::class, 'index'])->name('home');
// --------------------------------------------------------------------------------------------------------------------------

Route::get('/tourist-spot', [TaskController::class, 'touristSpot'])->name('tourist-spot');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// 新しい投稿の作成
Route::get('/tourist-spot/create', [TaskController::class, 'create'])->name('posts.create');

// //新規投稿保存
Route::post('tourist-spot/store', [TaskController::class, 'store'])->name('tourist-spot.store');

// -------------------------------------------------------------------------------------------------------------------------------


Route::get('/profile/show/{id}', [UserController::class, 'show'])->name('user.show');

// ユーザー情報の編集フォームを表示するためのルート
Route::post('/profile/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

// ユーザー情報を更新するためのルート
Route::put('/profile/{id}', [UserController::class, 'update'])->name('user.update');

Route::post('ajaxlike', 'GoodController@ajaxlike')->name('good.ajaxlike');

Route::post('/task/like', [GoodController::class, 'store']);
Route::post('/task/comment/{task_id}', [CommentController::class, 'store'])->name('comment.add');
Route::get('/task/comments/{task_id}', [CommentController::class, 'index'])->name('task.comments');

// ブックマークを追加するルート
Route::post('/bookmarks/add/{task_id}', [BookmarkController::class, 'addBookmark'])->name('bookmarks.add');
// ブックマークを削除するルート
Route::delete('/bookmarks/remove/{task_id}', [BookmarkController::class, 'removeBookmark'])->name('bookmarks.remove');
// ブックマーク一覧を表示するルート
Route::get('/profile/{id}', [BookmarkController::class, 'index'])->name('mypage.index');

// --------------------------------------------------------------------------------
Route::post('/post_list/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');

Route::put('/post_list/{id}', [TaskController::class, 'update'])->name('task.update');

Route::delete('/post_list/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

