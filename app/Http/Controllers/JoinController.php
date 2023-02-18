<?php

namespace App\Http\Controllers;

use App\Models\Join;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JoinController extends Controller
{
    public function join(Subreddit $subreddit,Request $request){
        $user = Auth::user();
        if(DB::table('subreddit_user')->where('user_id',$user->id)->exists()){
            $user->subreddits()->detach($subreddit);
            return back();
        }

        $user->subreddits()->attach($subreddit);
        return back();
        /* dd($user); */
    }
}
