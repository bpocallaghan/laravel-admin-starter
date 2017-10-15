<?php

namespace App\Listeners;

use App\Events\ContactUsFeedback;
use App\Notifications\ContactUsSubmitted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailContactUsToAdmin
{
    /**
     * Handle the event.
     *
     * @param  ContactUsFeedback $event
     * @return void
     */
    public function handle(ContactUsFeedback $event)
    {
        $data = $event->eloquent;

        notify_admins(ContactUsSubmitted::class, $data);

        log_activity('Contact Us', $data->fullname . ' submitted Contact Us.', $data);
    }
}
