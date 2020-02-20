<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ChangePassword\UpdateRequest;
use App\Services\Web\ChangePassword\UpdateService;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    /**
     * @var UpdateService $updateService
     */
    private $updateService;

    /**
     * Create a new controller instance.
     *
     * @param UpdateService $updateService
     */
    public function __construct(
        UpdateService $updateService
    ) {
        $this->updateService = $updateService;
    }

    /**
     * Show the form for change password.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('change-password.edit');
    }

    /**
     * Update the password of user.
     *
     * @param UpdateRequest $request
     * @return Response
     */
    public function update(UpdateRequest $request)
    {
        if (!$this->updateService->handle($request)) {
            return back()->withInput()->with('error', trans('passwords.incorrect'));
        }

        return back()->with('success', trans('passwords.changed'));
    }
}
