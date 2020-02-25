<?php

namespace App\Notifications\Messages;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Log;

class FcmMessage
{
    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH = 'high';
    const SOUND_DEFAULT = 'default';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string|array
     */
    private $to;

    /**
     * @var array
     */
    private $notification;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string normal|high
     */
    private $priority = self::PRIORITY_NORMAL;

    /**
     * @var string
     */
    private $sound = self::SOUND_DEFAULT;

    /**
     * Firebase constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
    }

    /**
     * @param string|array $recipient
     * @param bool $recipientIsTopic
     * @return $this
     */
    public function to($recipient, $recipientIsTopic = false)
    {
        if ($recipientIsTopic && is_string($recipient)) {
            $this->to = '/topics/' . $recipient;
        } elseif (is_array($recipient) && count($recipient) == 1) {
            $this->to = $recipient[0];
        } else {
            $this->to = $recipient;
        }

        return $this;
    }

    /**
     * @return string|array|null
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param array||null $data
     * @return $this
     */
    public function setData($data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string|array|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $notification
     * @return $this
     */
    public function setNotification(array $params)
    {
        $this->notification = $params;

        return $this;
    }

    /**
     * @return string|array|null
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param string $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return string|array|null
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $sound
     * @return $this
     */
    public function setSound($sound)
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send()
    {
        if (empty($this->to)) {
            return false;
        }

        return $this->request(config('fcm.send_url'));
    }

    /**
     * @param string $url
     * @return void
     */
    private function request(string $url)
    {
        try {
            $response = $this->client->post($url, array_merge($this->getHeaders(), $this->getBody()));

            Log::info('FCM response', [$response->getBody()->getContents()]);

            return json_decode($response->getBody());
        } catch (ClientException $exception) {
            Log::error('FCM error', [$exception->getMessage()]);
        }
    }

    /**
     * @return array
     */
    private function getHeaders()
    {
        return [
            'headers' => [
                'Authorization' => sprintf('key=%s', config('fcm.server_key')),
                'Content-Type' => 'application/json',
            ],
        ];
    }

    /**
     * @return array
     */
    private function getBody()
    {
        return [
            'body' => json_encode($this->formatData()),
        ];
    }

    /**
     * @return array
     */
    private function formatData()
    {
        $payload = [
            'priority' => $this->priority,
        ];

        if (is_array($this->to)) {
            $payload['registration_ids'] = $this->to;
        } elseif (!empty($this->to)) {
            $payload['to'] = $this->to;
        }

        if (isset($this->data) && count($this->data)) {
            $payload['data'] = $this->data;
        }

        if (isset($this->notification) && count($this->notification)) {
            $payload['notification'] = $this->notification;
            $payload['notification']['sound'] = $this->sound;
        }

        return $payload;
    }

}
