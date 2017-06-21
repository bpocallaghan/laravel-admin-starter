<?php

namespace App\Notifications;

use App\Models\FeedbackContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactUsSubmitted extends Notification
{
    use Queueable;

    /**
     * @var FeedbackContactUs
     */
    private $row;

    /**
     * Create a new notification instance.
     * @param FeedbackContactUs $row
     */
    public function __construct(FeedbackContactUs $row)
    {
        $this->row = $row;
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
        return (new MailMessage)->line($this->row->fullname . ' submitted contact us.')
            ->line('Fullname: ' . $this->row->fullname)
            ->line('Email: ' . $this->row->email)
            ->line('Phone: ' . $this->row->phone)
            ->line('Message: ' . $this->row->content);
    }

    /**
     * Notify via Database
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->row->fullname . ' submitted contact us.',
            'id'      => $this->row->id,
            'type'    => get_class($this->row),
        ];
    }
}
