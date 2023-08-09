<?php

declare(strict_types=1);

namespace App\Events\Worker;

use App\Models\Worker;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Worker $worker;

    /**
     * Create a new event instance.
     */
    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
