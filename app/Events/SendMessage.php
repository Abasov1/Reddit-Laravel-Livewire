<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $userId;
    public $typing;
    public $friendId;
    public $image;
    public function __construct($message,$userId,$friendId,$typing)
    {
        $this->message = $message;
        $this->userId = $userId;
        $this->friendId = $friendId;
        $this->typing = $typing;
        $user = User::where('id',$userId)->first();
        $this->image = $user->image;
    }

    public function broadcastOn()
    {
        return new Channel('messaga');
    }

    public function broadcastAs()
    {
        return 'message-sent';
    }
    public function broadcastWith(){
        return [
            'message' => $this->message,
            'user' => $this->userId,
            'image' => $this->image,
            'friend' => $this->friendId,
            'typing' => $this->typing
        ];
    }
}
