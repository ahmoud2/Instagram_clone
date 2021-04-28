<?php

use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use Illuminate\Routing\RouteGroup;

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

Route::resource('profiles', ProfilesController::class);

Route::resource('posts',PostsController::class);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'show'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('follow/{id}',[FollowsController::class,'store']);

// Comment Routes

Route::prefix('comment')->group(function () {
    Route::post('/{post_id}', [CommentsController::class,'store']);
});
