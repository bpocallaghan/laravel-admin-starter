<?php

namespace App\Listeners;

use App\Models\LogActivity;
use App\Events\ActivityWasTriggered;

class SaveActivity
{
    /**
     * Handle the event.
     *
     * @param ActivityWasTriggered $event
     */
    public function handle(ActivityWasTriggered $event)
    {
        $title = $event->title;
        if (strlen($title) < 2) {
            $title = str_replace(['App\\', 'Models\\'], '', get_class($event->eloquent));
        }

        $subject = null;
        if (!is_null($event->eloquent)) {
            $subject = get_class($event->eloquent);
        }
        $subjectId = $event->eloquent ? $event->eloquent->id : null;

        if ($event->eloquent && !strpos($subject, '\Models')) {
            $subjectId = null;
            $subject = 'App\User';
        }

        // log adjustment
        LogActivity::create([
            'title'        => $title,
            'description'  => $event->description,
            'subject_id'   => $subjectId,
            'subject_type' => $subject,
            'user_id'      => user()->id,
        ]);
    }
}
