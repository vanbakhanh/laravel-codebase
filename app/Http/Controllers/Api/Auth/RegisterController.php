<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\AbstractController;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Services\Api\Auth\RegisterService;

class RegisterController extends AbstractController
{
    /**
     * @var RegisterService
     */
    private $registerService;

    /**
     * Create a new controller instance.
     *
     * @param RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegisterRequest $request
     * @return Response
     */
    public function register(RegisterRequest $request)
    {
        $this->apiData = $this->registerService->handle($request);
        $this->apiMessage = trans('auth.sent');

        return $this->success();
    }
}
