<?php

namespace App\Mail;

use App\Models\FeedbackContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var FeedbackContactUs
     */
    public $contactUs;

    /**
     * Create a new message instance.
     * @param FeedbackContactUs $contactUs
     * @internal param $data
     */
    public function __construct(FeedbackContactUs $contactUs)
    {
        $this->contactUs = $contactUs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contact Us - ' . config('app.name'))
            ->to($this->contactUs->email, $this->contactUs->fullname)
            ->markdown('emails.contactus_client');
    }
}
