<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public $created_at;

    public function __construct($message, $user, $created_at)
    {
        $this->message = $message;
        $this->user = $user;
        $this->created_at = $created_at;
    }

    public function broadcastOn()
    {
        return new Channel('messages');
    }
}
