<?php

namespace App\Listeners;

use App\Events\ContactUsFeedback;
use App\Notifications\ContactUsSubmitted;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

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

        $users = User::all();
        foreach ($users as $k => $user) {
            $user->notify(new ContactUsSubmitted($data));
        }

        log_action('Contact Us', $data->fullname . ' submitted Contact Us.', $data);
        //Mail::send('emails.contactus_admin', ['obj' => $data], function ($message) use ($data) {
        //    $message = mail_to_admins($message);
        //    $message->subject($data->type . ' - ' . env('app.name'));
        //});
    }
}
