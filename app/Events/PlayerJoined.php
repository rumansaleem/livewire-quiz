<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $player;
    protected $session;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($player, $session)
    {
        $this->player = $player;
        $this->session = $session;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Admin.Quiz.' . $this->session->id);
    }

    public function broadcastWith()
    {
        return [
            'player' => $this->player->toArray()
        ];
    }
}
