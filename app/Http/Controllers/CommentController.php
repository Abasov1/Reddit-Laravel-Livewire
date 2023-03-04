<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Subreddit;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request,Subreddit $subreddit){
        if(!$request->user()->isBanned($subreddit)){
        $validated = $request->validate([
            'body' => 'required|max:255',
    ]);
        $post = Post::find($request->post_id);
        $comment = $request->user()->comments()->create([
            'post_id' => $post->id,
            'body' => $request->body,
        ]);
        auth()->user()->sendNotification($post->user->id,$post->id,$comment->id,null,null,'postcomment');
    }
        return back();
    }
    public function commentstore(Comment $comment,Subreddit $subreddit,Post $post,Request $request){
        if(!$request->user()->isBanned($subreddit)){
        $validated = $request->validate([
            'body' => 'required|max:255',
    ]);
        $subcomment = $request->user()->comments()->create([
            'post_id' => $post->id,
            'comment_id' => $comment->id,
            'body' => $request->body,
        ]);
            auth()->user()->sendNotification($comment->user->id,$post->id,$comment->id,$subcomment->id,null,'commentcomment');
        }

        return back();
    }
    public function destroy(Comment $comment,Subreddit $subreddit)
    {
        if(auth()->user()->isMod($subreddit)){
            $comment->delete();
        }else{
        $this->authorize('commentdelete',$comment);
        $comment->delete();
    }
        return back();
    }
    public function edit(Comment $comment){
        $this->authorize('commentdelete',$comment);
        $ecomment = Comment::find($comment->id);
        $comments = Comment::with('subcomments.subcomments')
            ->whereNull('post_id')->get();
        return back()->with([
            'ecomment' => $ecomment,
            'comments' => $comments
        ]);
    }
    public function parentupdate(Comment $comment,Subreddit $subreddit,Request $request){
        if(!$request->user()->isBanned($subreddit)){
        $this->authorize('commentdelete',$comment);
        $validated = $request->validate([
            'body' => 'required|max:255',
    ]);
        $comment->update([
            'user_id' => $comment->user_id,
            'post_id' => $comment->post_id,
            'body' => $request->body,
        ]);
    }
        return back();
    }
    public function childupdate(Comment $comment,Subreddit $subreddit,Request $request){
        if(!$request->user()->isBanned($subreddit)){
        $this->authorize('commentdelete',$comment);
        $validated = $request->validate([
            'body' => 'required|max:255',
    ]);
        $comment->update([
            'user_id' => $comment->user_id,
            'comment_id' => $comment->comment_id,
            'body' => $request->body,
        ]);
    }
        return back();
    }

}
