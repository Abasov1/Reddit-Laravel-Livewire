<?php

namespace App\Http\Livewire;

use App\Events\SendMessage;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewirePusherComponent;
use Illuminate\Support\Facades\Broadcast;
use Pusher\Pusher;


class ChatLive extends Component
{
    public $friends;
    public $messages;
    public $message;
public function tixla()
{
    $naxcivan = DB::table('user_user')->where('user_id',auth()->user()->id)->get();
    $frIds = collect($naxcivan)->pluck('friend_id');
    $this->friends = User::whereIn('id',$frIds)->get();
    $this->messages = DB::table('messages')->where('user_id',auth()->user()->id)->orWhere('friend_id',auth()->user()->id)->get();
}
    public function mount(){
        $naxcivan = DB::table('user_user')->where('user_id',auth()->user()->id)->get();
        $frIds = collect($naxcivan)->pluck('friend_id');
        $this->friends = User::whereIn('id',$frIds)->get();
        $this->messages = DB::table('messages')->where('user_id',auth()->user()->id)->orWhere('friend_id',auth()->user()->id)->get();

    }
    public function message($id){
        $friend = User::where('id',$id)->first();
        auth()->user()->messages()->attach($friend->id,['body'=>$this->message]);
        event(new SendMessage($this->message));
        $naxcivan = DB::table('user_user')->where('user_id',auth()->user()->id)->get();
        $frIds = collect($naxcivan)->pluck('friend_id');
        $this->friends = User::whereIn('id',$frIds)->get();
        $this->messages = DB::table('messages')->where('user_id',auth()->user()->id)->orWhere('friend_id',auth()->user()->id)->get();

    }
    public function updated(){
        $this->messages = DB::table('messages')->where('user_id',auth()->user()->id)->orWhere('friend_id',auth()->user()->id)->get();

    }
    public function render()
    {
        return view('livewire.chat-live');
    }
}
