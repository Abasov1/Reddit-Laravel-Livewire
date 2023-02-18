<?php

namespace App\Http\Controllers;

use App\Models\Subreddit;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function join(Subreddit $subreddit,Request $request){
        if($subreddit->joinedBy($request->user())){
            $subreddit->joins()->where('user_id',$request->user()->id)->delete() ;
            return back();
        }
        $subreddit->joins()->create([
            'user_id' => $request->user()->id,
        ]);
        return back();
        /* dd($user); */
    }
}
