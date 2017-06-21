<?php

namespace App\Events;

class ActionWasTriggered extends BaseEvent
{
    public $type;

    public $message;

    /**
     * Create a new event instance.
     * @param string $type
     * @param string $message
     * @param        $subject
     */
    public function __construct($type = '', $message = '', $subject)
    {
        $this->type = $type;
        $this->eloquent = $subject;
        $this->message = $message;
    }
}
