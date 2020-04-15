<?php

namespace App\Events;

use App\User;
use App\Model\Core\Order;
use App\Model\Core\Table;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOrder implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User that sent the message
     *
     * @var User
     */
    public $user;

    /**
     * Order details
     *
     * @var Order
     */
    public $order;

    /**
     * Table that sent the message
     *
     * @var Table
     */
    public $table;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user,Order $order)
    {
        $this->user = $user;
        $this->order = $order;
        $this->table = $order->service()->first()->table()->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('neworder.'.$this->user->rel_store_id);
    }
}
