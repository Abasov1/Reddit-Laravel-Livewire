<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class CommentLive extends Component
{
    public $post;
    public $body;
    public $commentid;
    public $comments;
    public $previewComment = null;
    public $inside = 'Comment';
    public $likecount;
    public $amount = 10;
    protected $listeners = ['bottomPage'=>'loadmore'];
    protected $rules = [
        'body' => 'required',
    ];
    public function store(){
        $this->validate();
        $createdcomment = auth()->user()->comments()->create([
            'post_id' => $this->post->id,
            'body' => $this->body,
            'comment_id' =>$this->commentid
        ]);
        if($this->commentid != null){
            $comant = Comment::where('id',$this->commentid)->first();
            auth()->user()->sendNotification($comant->user->id,$this->post->id,$this->commentid,$createdcomment->id,null,'commentcomment');
        }else{
            auth()->user()->sendNotification($this->post->user->id,$this->post->id,$createdcomment->id,null,null,'postcomment');
            $this->amount++;
        }
        $this->body = '';
        if($this->previewComment != null){
            $this->commentid = null;
            $this->previewComment = null;
            $this->body = '';
            $this->inside = 'Comment';
        }
        $this->comments = Comment::where('post_id',$this->post->id)
        ->with('subcomments.subcomments')
        ->whereNull('comment_id')
        ->latest()
        ->take($this->amount)
        ->get();
    }
    public function commentToggle($id){
        $this->commentid = $id;
        $this->previewComment = Comment::find($id);
        $this->inside = 'Reply';
    }
    public function resett(){
        $this->commentid = null;
        $this->previewComment = null;
        $this->body = '';
        $this->inside = 'Comment';
    }
    public function commentlike($id){
        $comment = Comment::where('id',$id)->first();
        $comments = Comment::where('post_id',$this->post->id)
        ->with('subcomments.subcomments')
        ->whereNull('comment_id')
        ->latest()
        ->take($this->amount)
        ->get();
        if($comment->likedBy(auth()->user())){
            $comment->likes()->where('user_id',auth()->user()->id)->delete() ;
        }else{
        $comment->likes()->create([
            'user_id' => auth()->user()->id,
        ]);
        if(!auth()->user()->notifications()->where(['duduk_id' => $comment->user->id,'comment_id' => $comment->id,'content' => 'likecomment'])->exists()){
            auth()->user()->sendNotification($comment->user->id,$this->post->id,$comment->id,null,null,'likecomment');
        }
    }
        $this->comments = $comments;
    }
    public function mount($post,$comments){
        $this->post = $post;
        $this->loadcomments();
    }
    public function loadcomments(){
        $this->comments = Comment::where('post_id',$this->post->id)
        ->with('subcomments.subcomments')
        ->whereNull('comment_id')
        ->latest()
        ->take($this->amount)
        ->get();
    }
    public function loadmore(){
        $this->amount+=10;
        $this->loadcomments();
    }
    public function render()
    {
        return view('livewire.comment-live');
    }
}
