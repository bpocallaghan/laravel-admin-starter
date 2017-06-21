<?php

namespace App\Listeners;

use App\Models\LogAction;
use App\Events\ActionWasTriggered;

class SaveAction
{
    /**
     * Handle the event.
     *
     * @param ActionWasTriggered $event
     */
    public function handle(ActionWasTriggered $event)
    {
        $type = $event->type;
        if (strlen($type) < 2) {
            $type = str_replace(['App\\', 'Models\\'], '', get_class($event->eloquent));
        }

        $subject = get_class($event->eloquent);
        $subjectId = $event->eloquent ? $event->eloquent->id : null;

        if ($event->eloquent && !strpos($subject, '\Models')) {
            $subjectId = null;
            $subject = 'App\User';
        }

        // log adjustment
        LogAction::create([
            'type'         => $type,
            'message'      => $event->message,
            'subject_id'   => $subjectId,
            'subject_type' => $subject,
            'user_id'      => user()->id,
        ]);
    }
}
