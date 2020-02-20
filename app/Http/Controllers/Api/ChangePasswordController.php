<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePassword\UpdateRequest;
use App\Services\Api\ChangePassword\UpdateService;

class ChangePasswordController extends AbstractController
{
    /**
     * Create a new controller instance.
     *
     * @param UpdateService $updateService
     */
    public function __construct(UpdateService $updateService)
    {
        $this->updateService = $updateService;
    }

    /**
     * Update the password of user.
     *
     * @param UpdateRequest $request
     * @return Response
     */
    public function update(UpdateRequest $request)
    {
        $this->updateService->handle($request);
        $this->apiMessage = trans('passwords.changed');

        return $this->success();
    }
}
