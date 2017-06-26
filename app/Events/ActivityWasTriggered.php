<?php

namespace App\Events;

class ActivityWasTriggered extends BaseEvent
{
    public $title;

    public $description;

    /**
     * Create a new event instance.
     * @param string $title
     * @param string $description
     * @param        $subject
     */
    public function __construct($title = '', $description = '', $subject = null)
    {
        $this->title = $title;
        $this->eloquent = $subject;
        $this->description = $description;
    }
}
