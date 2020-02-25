<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Common\FirebaseCloudMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ExampleFireBaseNotification extends Notification
{
    use Queueable;

    /**
     * @var object
     */
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $message = new FirebaseCloudMessage();
        $message
            ->setNotification([
                'title' => 'Example notification',
                'body' => $this->user->profile->last_name . ' has tested FireBaseNotification',
            ]);

        return $message;
    }
}
