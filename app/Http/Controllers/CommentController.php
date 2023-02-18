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


}
