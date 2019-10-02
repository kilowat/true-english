<?php

namespace App\Providers;

use App\Models\WordCard;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WordCardExcelDownloaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $wordCard;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(WordCard $wordCard)
    {
        $this->wordCard = $wordCard;
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
