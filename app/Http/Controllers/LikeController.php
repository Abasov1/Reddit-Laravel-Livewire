<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post,Request $request){
        if($post->likedBy($request->user())){
            $post->likes()->where('user_id',$request->user()->id)->delete() ;
            return response()->json(['success' => true]);
        }
        $post->likes()->create([
            'user_id' => $request->user()->id,

        ]);
        return response()->json(['success' => true]);
        return back();
        /* dd($user); */
    }
    public function commentstore(Comment $comment,Request $request){
        // return $comment;
        if($comment->likedBy($request->user())){
            $comment->likes()->where('user_id',$request->user()->id)->delete() ;
            return back();
        }
        $comment->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        return back();
        /* dd($user); */
    }
}
