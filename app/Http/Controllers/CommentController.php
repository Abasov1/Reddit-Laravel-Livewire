<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'body' => 'required|max:255',
    ]);
        $request->user()->comments()->create([
            'post_id' => $request->post_id,
            'body' => $request->body,
        ]);

        return back();
    }
    public function commentstore(Comment $comment,Request $request){
        $validated = $request->validate([
            'body' => 'required|max:255',
    ]);
        $request->user()->comments()->create([
            'comment_id' => $comment->id,
            'body' => $request->body,
        ]);

        return back();
    }
    public function destroy(Comment $comment)
    {
        $this->authorize('commentdelete',$comment);
        $comment->delete();
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
    public function parentupdate(Request $request,$id){
        $comment = Comment::find($id);
        $this->authorize('commentdelete',$comment);
        $validated = $request->validate([
            'body' => 'required|max:255',
    ]);
        $comment->update([
            'user_id' => $comment->user_id,
            'post_id' => $comment->post_id,
            'body' => $request->body,
        ]);
        return back();
    }
    public function childupdate(Request $request,$id){
        $comment = Comment::find($id);
        $this->authorize('commentdelete',$comment);
        $validated = $request->validate([
            'body' => 'required|max:255',
    ]);
        $comment->update([
            'user_id' => $comment->user_id,
            'comment_id' => $comment->comment_id,
            'body' => $request->body,
        ]);
        return back();
    }

}
