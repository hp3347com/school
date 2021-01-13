<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SignUp
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ext;
    public $user_id;
    public $type;

    /**
     * Create a new event instance.
     *
     * @param $user_id
     * @param $type
     * @param $ext
     */
    public function __construct($user_id,$type,$ext)
    {
        $this->user_id = $user_id;
        $this->type = $type;
        $this->ext=$ext;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
