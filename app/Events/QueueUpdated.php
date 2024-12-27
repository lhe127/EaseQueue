<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class QueueUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public $queueNumber;
    public $counterNumber;

    public function __construct($queueNumber, $counterNumber)
    {
        $this->queueNumber = $queueNumber;
        $this->counterNumber = $counterNumber;
    }

    public function broadcastAs()
    {
        return 'queue.updated';
    }

    public function broadcastOn()
    {
        return new Channel('queue-updates');
    }

    public function broadcastWith()
    {
        return [
            'queue_number' => $this->queueNumber,
            'counter_number' => $this->counterNumber,
        ];
    }
}
