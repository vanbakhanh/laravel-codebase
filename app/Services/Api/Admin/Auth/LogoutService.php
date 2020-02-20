<?php

namespace App\Services\Api\Admin\Auth;

use App\Services\AbstractService;
use Auth;

class LogoutService extends AbstractService
{
    /**
     * LogoutService constructor.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle a logout request to the application.
     *
     * @param Request $request
     */
    public function handle($request)
    {
        return $this->transaction(function () {
            Auth::user()->token()->revoke();
        });
    }
}
