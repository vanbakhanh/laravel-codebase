<?php

namespace App\Notifications\Api;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Token for reset password.
     *
     * @var string
     */
    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $munitesExpired = config('auth.passwords.users.expire');

        return (new MailMessage)
                    ->greeting(trans('passwords.email_reset.greeting'))
                    ->line(trans('passwords.email_reset.reason'))
                    ->line(trans('passwords.email_reset.token', ['token' => strtoupper($this->token)]))
                    ->line(trans('passwords.email_reset.expired', ['minutes' => $munitesExpired]))
                    ->line(trans('passwords.email_reset.remind'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
