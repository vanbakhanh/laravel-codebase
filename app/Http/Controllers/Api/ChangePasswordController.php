<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePassword\UpdateRequest;
use App\Services\Api\ChangePassword\ChangePasswordService;

class ChangePasswordController extends AbstractController
{
    /**
     * Create a new controller instance.
     *
     * @param ChangePasswordService $changePasswordService
     */
    public function __construct(ChangePasswordService $changePasswordService)
    {
        $this->changePasswordService = $changePasswordService;
    }

    /**
     * Update the password of user.
     *
     * @param UpdateRequest $request
     * @return Response
     */
    public function update(UpdateRequest $request)
    {
        $this->changePasswordService->handle($request);
        $this->apiMessage = trans('passwords.changed');

        return $this->success();
    }
}
