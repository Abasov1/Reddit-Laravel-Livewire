<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
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
        if(!$request->user()->notifications()->where(['duduk_id' => $post->user->id,'post_id' => $post->id,'content' => 'likepost'])->exists()){
        $request->user()->sendNotification($post->user->id,$post->id,null,null,null,'likepost');
    }
        return response()->json(['success' => true,'message' => $post->user->id]);
        return back();
        /* dd($user); */
    }
    public function commentstore(Comment $comment,Post $post,Request $request){
        if(!auth()->user()->notifications()->where(['duduk_id' => $comment->user->id,'comment_id' => $comment->id,'content' => 'likecomment'])->exists()){
            auth()->user()->sendNotification($comment->user->id,$post->id,$comment->id,null,null,'likecomment');
        }

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
