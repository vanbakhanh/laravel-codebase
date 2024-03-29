<?php

namespace App\Notifications\Channels;

use App\Services\Web\FcmNotification\FcmNotificationService;
use Illuminate\Notifications\Notification;

class FcmChannel
{
    /**
     * @var FcmNotificationService
     */
    private $fcmNotificationService;

    /**
     * FcmChannel constructor.
     *
     * @param FcmNotificationService $fcmNotificationService
     */
    public function __construct(FcmNotificationService $fcmNotificationService)
    {
        $this->fcmNotificationService = $fcmNotificationService;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFcm($notifiable);

        if (!$message instanceof FcmMessage) {
            return;
        }

        // Get device token of user.
        if (is_null($message->getTo())) {
            if ($to = $notifiable->routeNotificationFor('fcm', $notification)) {
                $message->to($to);
            }
        }

        // Push fcm notification.
        $message->send();

        // Save notification to database.
        $this->save($notifiable->id, user()->id, $message);
    }

    /**
     * Save notification to database.
     *
     * @return void
     */
    private function save($receiverId, $senderId, FcmMessage $message)
    {
        $notificationData = [
            'receiver_id' => $receiverId,
            'sender_id' => $senderId,
            'data' => $message->getNotification(),
            'type' => $message->getData()['type'] ?? null,
        ];

        $this->fcmNotificationService->create(request()->merge($notificationData));
    }
}
