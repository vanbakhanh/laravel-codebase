<?php

namespace App\Services\Api\Passport;

use App\Exceptions\Api\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PassportService
{
    /**
     * @var Client
     */
    private $http;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->http = new Client(['verify' => false]);
    }

    /**
     * Handle reponse and exception.
     *
     * @param callable $request
     * @return Response
     *
     * @throws ApiException
     */
    public function request(callable $request)
    {
        try {
            $response = call_user_func($request);

            return json_decode($response->getBody());
        } catch (RequestException $exception) {
            if ($exception->hasResponse()) {
                $response = json_decode($exception->getResponse()->getBody());

                throw new ApiException($response->message);
            }

            throw new ApiException($exception->getMessage());
        }
    }

    /**
     * Create password grant token.
     *
     * @param array $data
     * @param string $scope
     * @return Response
     */
    public function passwordGrantToken(array $data, $scope = '')
    {
        return $this->request(function () use ($data, $scope) {
            return $this->http->post(env('APP_URL') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $data['client_id'],
                    'client_secret' => $data['client_secret'],
                    'username' => $data['email'],
                    'password' => $data['password'],
                    'scope' => $scope,
                ],
            ]);
        });
    }

    /**
     * Refresh access token.
     *
     * @param array $data
     * @return Response
     */
    public function refreshGrantToken(array $data)
    {
        return $this->request(function () use ($data) {
            return $this->http->post(env('APP_URL') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $data['refresh_token'],
                    'client_id' => $data['client_id'],
                    'client_secret' => $data['client_secret'],
                ],
            ]);
        });
    }

    /**
     * Create social grant token.
     *
     * @param User $user
     * @param array $client
     * @param string $scope
     * @return Response
     */
    public function socialGrantToken($user, $client, $scope = '')
    {
        return $this->request(function () use ($user, $client, $scope) {
            return $this->http->post(env('APP_URL') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'social',
                    'client_id' => $client['client_id'],
                    'client_secret' => $client['client_secret'],
                    'social_id' => $user->social_id,
                    'social_name' => $user->social_name,
                    'scope' => $scope,
                ],
            ]);
        });
    }
}
