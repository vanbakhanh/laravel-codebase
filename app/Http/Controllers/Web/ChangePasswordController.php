<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ChangePassword\UpdateRequest;
use App\Services\Web\ChangePassword\ChangePasswordService;

class ChangePasswordController extends Controller
{
    /**
     * @var ChangePasswordService $changePasswordService
     */
    private $changePasswordService;

    /**
     * Create a new controller instance.
     *
     * @param ChangePasswordService $changePasswordService
     */
    public function __construct(
        ChangePasswordService $changePasswordService
    ) {
        $this->changePasswordService = $changePasswordService;
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
        if (!$this->changePasswordService->handle($request)) {
            return back()->withInput()->with('error', trans('passwords.incorrect'));
        }

        return back()->with('success', trans('passwords.changed'));
    }
}
