<?php

namespace App\Http\Controllers\Admin\Api\Auth;

use App\Http\Controllers\Api\AbstractController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RefreshTokenRequest;
use App\Services\Api\Admin\Auth\LoginService;
use App\Services\Api\Admin\Auth\LogoutService;
use App\Services\Api\Auth\RefreshTokenService;
use Auth;
use Illuminate\Http\Request;

class LoginController extends AbstractController
{
    /**
     * @var LoginService
     */
    private $loginService;

    /**
     * @var LogoutService
     */
    private $logoutService;

    /**
     * @var RefreshTokenService
     */
    private $refreshTokenService;

    /**
     * Create a new controller instance.
     *
     * @param LoginService $loginService
     */
    public function __construct(
        LoginService $loginService,
        LogoutService $logoutService,
        RefreshTokenService $refreshTokenService
    ) {
        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
        $this->refreshTokenService = $refreshTokenService;
    }

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return Response
     *
     */
    public function login(LoginRequest $request)
    {
        $this->apiData = $this->loginService->handle($request);

        return $this->success();
    }

    /**
     * Handle a logout request to the application.
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request)
    {
        $this->logoutService->handle($request);
        $this->apiMessage = trans('auth.logout');

        return $this->success();
    }

    /**
     * Refresh access token.
     *
     * @param RefreshTokenRequest $request
     * @return Response
     */
    public function refresh(RefreshTokenRequest $request)
    {
        $this->apiData = $this->refreshTokenService->handle($request);

        return $this->success();
    }
}
