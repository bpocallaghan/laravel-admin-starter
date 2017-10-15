<?php

namespace App\Notifications;

use App\Models\FeedbackContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactUsSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var FeedbackContactUs
     */
    private $contactUs;

    /**
     * Create a new notification instance.
     * @param FeedbackContactUs $contactUs
     */
    public function __construct(FeedbackContactUs $contactUs)
    {
        $this->contactUs = $contactUs;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Contact Us')
            ->greeting("Dear {$notifiable->firstname}")
            ->line("The following information was submitted from the <strong>Contact Us</strong>.")
            ->line('&nbsp;')
            ->line("<strong>Contact Us Details</strong>")
            ->line("Fullname: {$this->contactUs->fullname}")
            ->line("Email: {$this->contactUs->email}")
            ->line("Phone: {$this->contactUs->phone}")
            ->line("Enquiry: {$this->contactUs->content}")
            ->action('View Contact Us Report', url('/admin/reports/contact-us'));
    }

    /**
     * Notify via Database
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->contactUs->fullname . ' submitted contact us.',
            'id'      => $this->contactUs->id,
            'type'    => get_class($this->contactUs),
        ];
    }
}
