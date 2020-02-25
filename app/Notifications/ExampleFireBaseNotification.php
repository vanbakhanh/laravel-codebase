<?php

namespace App\Notifications;

use App\Notifications\Channels\FcmChannel;
use App\Notifications\Messages\FcmMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ExampleFireBaseNotification extends Notification
{
    use Queueable;

    /**
     * @var object
     */
    private $object;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FcmChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return object
     */
    public function toFcm($notifiable)
    {
        return (new FcmMessage)
            ->setNotification([
                'title' => 'Notification title',
                'body' => 'Notification body',
            ]);
    }
}
