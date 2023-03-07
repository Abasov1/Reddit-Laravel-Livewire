<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class CommentLive extends Component
{
    public $post;
    public $body;
    public $commentid;
    public $comments;
    public $previewComment;
    protected $rules = [
        'body' => 'required',
    ];
    public function store(){
        $this->validate();
        $post = Post::where('id',$this->post->id)->first();
        auth()->user()->comments()->create([
            'post_id' => $this->post->id,
            'body' => $this->body,
            'comment_id' =>$this->commentid
        ]);
        $this->body = '';
        $this->post = $post;
    }
    public function commentToggle($id){
        $this->commentid = $id;
        $this->previewComment = Comment::find($id);
    }
    public function mount($post){
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.comment-live');
    }
}
