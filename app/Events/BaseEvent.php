<?php

namespace App\Events;

use Illuminate\Support\Facades\Event;
use Illuminate\Queue\SerializesModels;

class BaseEvent extends Event
{
    use SerializesModels;

    public $eloquent;

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
