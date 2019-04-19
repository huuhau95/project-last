<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FeedbackEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $userId;
    public $userAvatar;
    public $userName;
    public $productId;
    public $content;
    public $status;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->$id = $data['id'];
        $this->$userId = $data['user_id'];
        $this->$userAvatar = $data['user_avatar'];
        $this->$userName = $data['user_name'];
        $this->$productId = $data['product_id'];
        $this->$content = $data['content'];
        $this->$status = $data['status'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('sendFeedback');
    }
}
