<?php

namespace App\Services\Api\Social;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use App\Services\Api\Passport\PassportService;
use Socialite;

class LoginService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var PassportService
     */
    private $passportService;

    /**
     * LoginService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(
        UserRepository $repository,
        PassportService $passportService
    ) {
        $this->repository = $repository;
        $this->passportService = $passportService;
    }

    /**
     * Handle a social login request to the application.
     *
     * @param Request $request
     * @return array
     */
    public function handle($request)
    {
        $token = $request->token;
        $provider = $request->provider;
        $client = $request->only('client_id', 'client_secret');
        $userSocial = Socialite::driver($provider)->userFromToken($token);

        if (!$user = $this->repository->getSocialAccount($userSocial->getId(), $provider)) {
            $user = $this->transaction(function () use ($provider, $userSocial) {
                return $this->repository->createUserTypeSocial($provider, $userSocial);
            });
        }

        $responses = $this->transaction(function () use ($user, $client) {
            return $this->passportService->socialGrantToken($user, $client);
        });
        $responses->user = $user->load('profile');

        return $responses;
    }
}
