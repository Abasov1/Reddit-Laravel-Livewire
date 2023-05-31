<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userid;
    public $targetid;
    public function __construct($userId,$targetId)
    {
        $this->userid = $userId;
        $this->targetid = $targetId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notifications');
    }
    public function broadcastAs()
    {
        return 'notification';
    }
    public function broadcastWith(){
        return [
            'userid' => $this->userid,
            'targetid' => $this->targetid
        ];
    }
}
