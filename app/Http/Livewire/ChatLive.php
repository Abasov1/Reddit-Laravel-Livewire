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
    public $frient;
    public $messages;
    public $message;
    public $typing;
    protected $listeners = [
        'haramMoment' => 'dayday',
        'setTyping' => 'setTyping',
        'removeTyping' => 'removeTyping'
    ];
    public function tixla(){
        $naxcivan = DB::table('user_user')->where('user_id',auth()->user()->id)->get();
        $frIds = collect($naxcivan)->pluck('friend_id');
        $this->friends = User::whereIn('id',$frIds)->get();
        $this->bunnanAl();

    }
    public function mount(){
        $naxcivan = DB::table('user_user')->where('user_id',auth()->user()->id)->get();
        $frIds = collect($naxcivan)->pluck('friend_id');
        $this->friends = User::whereIn('id',$frIds)->get();
    }
    public function show($id){
        $this->frient = User::where('id',$id)->first();
        $this->bunnanAl();
    }
    public function message($id){
        if($this->message != ''){
            $babas = $this->message;
            $this->message='';
            $friend = User::where('id',$id)->first();
            auth()->user()->messages()->attach($friend->id,['body'=>$babas,'seen'=>false,'created_at'=>now(),'updated_at'=>now()]);
            event(new SendMessage($babas,auth()->user()->id,$this->frient->id,'yox'));
        }
        $this->bunnanAl();
    }
    public function dayday($data){
        $this->bunnanAl();

    }
    public function updated(){
        $this->bunnanAl();

    }
    public function bunnanAl(){
        $userId = auth()->user()->id;
        $friendId = $this->frient->id;
        $messages = DB::table('messages')
        ->where(function ($q) use ($userId, $friendId) {
            $q->where('user_id', $userId)
              ->where('friend_id', $friendId);
        })
        ->orWhere(function ($q) use ($userId, $friendId) {
            $q->where('user_id', $friendId)
              ->where('friend_id', $userId);
        })
        ->latest()
        ->paginate(10)->items();
        DB::table('messages')
        ->where(function ($q) use ($userId, $friendId) {
            $q->where('user_id', $friendId)
              ->where('friend_id', $userId);
        })->update([
            'seen'=>true,
        ]);
        $this->messages = array_reverse($messages);
    }
    public function render()
    {
        return view('livewire.chat-live');
    }
}
