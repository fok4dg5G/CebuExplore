<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// --------------------------------------------------------------------------------------------------------------------------
Route::get('/tourist-spot', [App\Http\Controllers\TaskController::class, 'touristSpot'])->name('tourist-spot');
Route::get('/hotel', [App\Http\Controllers\TaskController::class, 'hotel'])->name('hotel');
Route::get('/food', [App\Http\Controllers\TaskController::class, 'food'])->name('food');
Route::get('/transportation', [App\Http\Controllers\TaskController::class, 'transportation'])->name('transportation');
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
// 新しい投稿の作成
Route::get('/tourist-spot/create', [App\Http\Controllers\TaskController::class, 'create'])->name('posts.create');
// //新規投稿保存
Route::post('tourist-spot/store', [App\Http\Controllers\TaskController::class, 'store'])->name('tourist-spot.store');
Route::post('hotel/store', [App\Http\Controllers\TaskController::class, 'storehotel'])->name('hotel.store');
Route::post('food/store', [App\Http\Controllers\TaskController::class, 'storeFood'])->name('food.store');
Route::post('transportation/store', [App\Http\Controllers\TaskController::class, 'storeTransportation'])->name('transportation.store');
//新規投稿削除
Route::delete('/tourist-spot/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/profile/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
// ユーザー情報の編集フォームを表示するためのルート
Route::post('/profile/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
// ユーザー情報を更新するためのルート
Route::put('/profile/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
// Route::post('/profile/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('ajaxlike', 'GoodController@ajaxlike')->name('good.ajaxlike');
Route::post('/task/like', [App\Http\Controllers\GoodController::class, 'store']);
// ブックマークを追加するルート
Route::post('/bookmarks/add/{task_id}', [App\Http\Controllers\BookmarkController::class, 'addBookmark'])->name('bookmarks.add');
// ブックマークを削除するルート
Route::delete('/bookmarks/remove/{task_id}', [App\Http\Controllers\BookmarkController::class, 'removeBookmark'])->name('bookmarks.remove');
// ブックマーク一覧を表示するルート
Route::get('/profile/{id}', [App\Http\Controllers\BookmarkController::class, 'index'])->name('mypage.index');
// --------------------------------------------------------------------------------
Route::post('/post_list/edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('task.edit');
Route::put('/post_list/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('task.update');
Route::delete('/post_list/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('task.destroy');