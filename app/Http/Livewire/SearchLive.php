<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Role;
use App\Models\Subreddit;
use App\Models\User;
use Livewire\Component;

class SearchLive extends Component
{
    public $posts;
    public $index;
    public $comments;
    public $subreddits;
    public $isjoined = false;
    public $users;
    public function mount($posts,$index){
        $this->posts = $posts;
        $this->index = $index;
    }
    public function loadcomments(){
        $this->comments = Comment::where('body', 'LIKE', '%' . $this->index . '%')->get();
    }
    public function loadcommunities(){
        $this->subreddits = Subreddit::where('name','LIKE','%' . $this->index . '%')->get();
    }
    public function loadusers(){
        $this->users = User::where('name','LIKE','%' . $this->index . '%')->whereNot('id',auth()->user()->id)->get();
    }
    public function go($id){
        $comment = Comment::where('id',$id)->first();
        return redirect('/post/'.$comment->post->id);
    }
    public function join($id){
        $subreddit = Subreddit::where('id',$id)->first();
        if(auth()->user()->isJoined($subreddit)){
            auth()->user()->subreddits()->detach($subreddit);
            if(auth()->user()->isMod($subreddit)){
                $role = Role::where('name', 'moderator')->first();
                auth()->user()->subredditss()->detach($subreddit->id, ['role_id' => $role->id]);
            $this->subreddits = Subreddit::where('name','LIKE','%' . $this->index . '%')->get();

            }
        }else{
            auth()->user()->subreddits()->attach($subreddit);
            $this->subreddits = Subreddit::where('name','LIKE','%' . $this->index . '%')->get();

        }
    }
    public function render()
    {
        return view('livewire.search-live');
    }
}
