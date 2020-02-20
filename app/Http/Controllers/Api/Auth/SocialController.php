<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\AbstractController;
use App\Http\Requests\Api\Auth\LoginSocialRequest;
use App\Services\Api\Social\LoginService;

class SocialController extends AbstractController
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
     * Handle a social login request to the application.
     *
     * @param LoginSocialRequest $request
     * @return Response
     */
    public function login(LoginSocialRequest $request)
    {
        $this->apiData = $this->loginService->handle($request);

        return $this->success();
    }
}
