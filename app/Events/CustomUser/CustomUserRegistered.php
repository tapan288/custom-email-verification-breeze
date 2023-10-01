<?php

namespace App\Events\CustomUser;

use App\Models\CustomUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CustomUserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public CustomUser $user;

    /**
     * Create a new event instance.
     */
    public function __construct(CustomUser $user)
    {
        $this->user = $user;
    }
}
