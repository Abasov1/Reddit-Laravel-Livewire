<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Subcommentus extends Component
{
    public $comment;
    public $post;
    public function mount(Comment $comment,Post $post){
        $this->comment = $comment;
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.subcommentus');
    }
}
