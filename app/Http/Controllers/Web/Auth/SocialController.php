<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Services\Web\Auth\Social\LoginService;
use Socialite;

class SocialController extends Controller
{
    /**
     * @var LoginService
     */
    private $loginService;

    /**
     * Create a new controller instance.
     *
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Redirect the user to the social authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from social.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        if ($this->loginService->handle($provider)) {
            return redirect()->route('home.index');
        };

        return redirect()->route('login');
    }
}
