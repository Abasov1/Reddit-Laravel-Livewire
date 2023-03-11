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
use App\Http\Controllers\ModController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
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
    Route::post('/lik/{comment}/{post}',[LikeController::class,'commentstore']);

    Route::post('/comment/{subreddit}',[CommentController::class,'store']);
    Route::post('/commentt/{comment}/{subreddit}/{post}',[CommentController::class,'commentstore']);
    Route::delete('/commentdelete/{comment}/{subreddit}',[CommentController::class,'destroy']);
    Route::put('/parentedit/{comment}/{subreddit}',[CommentController::class,'parentupdate']);
    Route::put('/childupdate/{comment}/{subreddit}',[CommentController::class,'childupdate']);
    Route::get('/commentedit/{comment}',[CommentController::class,'edit']);
    Route::get('/childedit/{comment}',[CommentController::class,'edit']);

    Route::resource('/subreddit',SubredditController::class);
    Route::post('/giverole/{user}/{subreddit}',[ModController::class,'givemod']);
    Route::post('/takerole/{user}/{subreddit}',[ModController::class,'takemod']);
    Route::post('/takemodrequest/{user}/{subreddit}',[ModController::class,'takemodrequest']);
    Route::post('/searchmod/{name}/{subreddit}',[ModController::class,'searchmod']);
    Route::get('/searchmod/{name}',[JoinController::class,'searchmodik']);

    Route::get('/notifications/{user}',[NotificationController::class,'index']);
    Route::post('/removenotification/{user}/{subreddit}',[NotificationController::class,'remove']);
    Route::post('/deletenotification/{id}',[NotificationController::class,'removenotification']);
    Route::post('/acceptmodrequest/{user}/{mod}/{subreddit}',[ModController::class,'acceptmodrequest']);

    Route::post('/ban/{post}',[JoinController::class,'ban']);
    Route::post('/banuser/{name}/{subreddit}',[JoinController::class,'banuser']);

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

    Route::post('/qiril',[SearchController::class,'search']);

});
Route::view('/test','other.chat');


