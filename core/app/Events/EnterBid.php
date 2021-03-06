<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EnterBid implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $product;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($product,$user)
    {
        $this->product=$product;
        $this->user=$user;
        // $this->productBid=$productBid;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('bidenter.'.$this->product['product_id']);
    }
}
