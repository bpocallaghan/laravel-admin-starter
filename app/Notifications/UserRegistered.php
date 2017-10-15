<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Please confirm your account')
            ->greeting("Dear {$notifiable->firstname}")
            ->line("Thank you for registering at <strong>" . config('app.name') . '</strong>.')
            ->line("&nbsp;")
            ->line('Before you can sign into your account. Please confirm your email address.')
            ->action('Confirm Account',
                url('/auth/register/confirm/' . $notifiable->confirmation_token));
        //->line("<strong>Account Holder Details</strong>")
        //->line("Fullname: {$notifiable->fullname}")
        //->line("Email: {$notifiable->email}")
        //->line("&nbsp;")

    }
}
