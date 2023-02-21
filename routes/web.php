<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GirisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubredditController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['guest'])->group(function () {
Route::get('/register',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('/homes', HomeController::class);
    Route::resource('/post', PostController::class);
    Route::post('/like/{post}',[LikeController::class,'store']);
    Route::post('/lik/{comment}',[LikeController::class,'commentstore']);

    Route::post('/comment/{subreddit}',[CommentController::class,'store']);
    Route::post('/comment/{comment}/{subreddit}',[CommentController::class,'commentstore']);
    Route::delete('/commentdelete/{comment}',[CommentController::class,'destroy']);
    Route::put('/parentedit/{comment}/{subreddit}',[CommentController::class,'parentupdate']);
    Route::put('/childupdate/{comment}/{subreddit}',[CommentController::class,'childupdate']);
    Route::get('/commentedit/{comment}',[CommentController::class,'edit']);
    Route::get('/childedit/{comment}',[CommentController::class,'edit']);

    Route::resource('/subreddit',SubredditController::class);
    Route::post('/giverole/{user}/{subreddit}',[JoinController::class,'givemod']);
    Route::post('/takerole/{user}/{subreddit}',[JoinController::class,'takemod']);

    Route::post('/ban/{user}/{subreddit}',[JoinController::class,'ban']);
    Route::post('/unban/{user}/{subreddit}',[JoinController::class,'unban']);
    Route::get('/bannedusers/{id}',[JoinController::class,'index']);

    Route::post('/join/{subreddit}',[JoinController::class,'join']);
    Route::get('/logout',[LoginController::class,'logout']);
});

Route::get('/test',function(){
    return view('other.test');
});

