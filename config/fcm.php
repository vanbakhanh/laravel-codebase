<?php

return [
    /**
     * Set your FCM Server Key
     * Change to yours
     */

    'send_url' => env('FCM_SEND_URL', 'https://fcm.googleapis.com/fcm/send'),

    'server_key' => env('FCM_SERVER_KEY', ''),

    'sender_id' => env('FCM_SENDER_ID', ''),

    'subscription_topic' => env('FCM_SUBSCRIPTION_TOPIC', ''),

];
