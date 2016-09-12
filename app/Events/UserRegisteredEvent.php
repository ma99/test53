<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserRegisteredEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    
    public $user;
    
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
         //return new PrivateChannel('order.'.$this->update->order_id);
        //return new Channel('channel_one'); //public 
        //return new PrivateChannel('mychannel_one');
        return new PresenceChannel('mychannel_one');
    }
}
