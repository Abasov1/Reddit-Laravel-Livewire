<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FIlterController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GirisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubredditController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
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
    Route::post('/commentt/{comment}/{subreddit}/{post}',[CommentController::class,'commentstore']);
    Route::delete('/commentdelete/{comment}/{subreddit}',[CommentController::class,'destroy']);
    Route::put('/parentedit/{comment}/{subreddit}',[CommentController::class,'parentupdate']);
    Route::put('/childupdate/{comment}/{subreddit}',[CommentController::class,'childupdate']);
    Route::get('/commentedit/{comment}',[CommentController::class,'edit']);
    Route::get('/childedit/{comment}',[CommentController::class,'edit']);

    Route::resource('/subreddit',SubredditController::class);
    Route::post('/giverole/{user}/{subreddit}',[JoinController::class,'givemod']);
    Route::post('/takerole/{user}/{subreddit}',[JoinController::class,'takemod']);
    Route::post('/takemodrequest/{user}/{subreddit}',[NotificationController::class,'takemodrequest']);
    Route::post('/searchmod/{name}/{subreddit}',[JoinController::class,'searchmod']);
    Route::get('/searchmod/{name}',[JoinController::class,'searchmodik']);

    Route::get('/notifications/{user}',[NotificationController::class,'index']);
    Route::post('/removenotification/{user}/{subreddit}',[NotificationController::class,'remove']);
    Route::post('/deletenotification/{id}',[NotificationController::class,'removenotification']);
    Route::post('/acceptnotification/{user}/{mod}/{subreddit}',[NotificationController::class,'accept']);

    Route::post('/ban/{post}',[JoinController::class,'ban']);
    Route::post('/unban/{user}/{subreddit}',[JoinController::class,'unban']);
    Route::get('/bannedusers/{id}',[JoinController::class,'index']);

    Route::post('/join/{subreddit}',[JoinController::class,'join']);
    Route::post('/add/{user}',[FriendController::class,'add']);
    Route::post('/unadd/{user}',[FriendController::class,'unadd']);
    Route::post('/ignore/{user}',[FriendController::class,'ignore']);
    Route::post('/leavefriendship/{user}',[FriendController::class,'leave']);

    Route::put('/ppupdate/{user}',[FriendController::class,'ppupdate']);
    Route::put('/userupdate/{user}',[FriendController::class,'userupdate']);

    Route::get('/settings/{user}',[FriendController::class,'settings']);
    Route::get('/subsettings/{subreddit}',[FriendController::class,'subsettings']);
    Route::get('/settingsedit/{user}',[FriendController::class,'settingsedit']);
    Route::post('/password-confirmation',[FriendController::class,'confirmate']);

    Route::get('subreddit/{id}/{date}',[FIlterController::class,'filter']);
    Route::get('createpost/{id}',[FIlterController::class,'createpost']);

    Route::get('/logout',[LoginController::class,'logout']);

    Route::get('/friends/{user}',[FriendController::class,'index']);

});



