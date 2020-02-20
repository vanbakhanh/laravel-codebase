<?php

namespace App\Services\Web\Auth\Social;

use App\Repositories\Contracts\UserRepository;
use App\Services\AbstractService;
use Auth;
use Socialite;

class LoginService extends AbstractService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * LoginService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(
        UserRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Handle a social login request to the application.
     *
     * @param Request $request
     * @return array
     */
    public function handle($provider)
    {
        $userSocial = Socialite::driver($provider)->user();

        if (!$user = $this->repository->getSocialAccount($userSocial->getId(), $provider)) {
            $user = $this->transaction(function () use ($provider, $userSocial) {
                return $this->repository->createUserTypeSocial($provider, $userSocial);
            });
        }

        return $this->handleLogin($user);
    }

    private function handleLogin($user)
    {
        Auth::login($user);

        return Auth::check();
    }
}
