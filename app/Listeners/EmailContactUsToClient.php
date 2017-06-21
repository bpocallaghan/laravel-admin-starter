<?php

namespace App\Listeners;

use Mail;
use App\Events\ContactUsFeedback;

class EmailContactUsToClient
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

        Mail::send('emails.customer_notify', ['obj' => $data], function ($message) use ($data) {
            $message->to($data->email, $data->firstname . ' ' . $data->lastname)
                ->subject($data->type . ' - ' . config('app.name'));
        });
    }
}
