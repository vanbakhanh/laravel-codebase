<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($success = null, $data = null, $code = HTTP_OK) {
            $success = $success ?: trans('httpstatus.' . HTTP_OK);

            return Response::json([
                'code' => $code,
                'success' => $success,
                'data' => $data,
            ], $code);
        });

        Response::macro('error', function ($error = null, $data = null, $code = HTTP_INTERNAL_SERVER_ERROR) {
            $code = $code > 0 ? $code : HTTP_INTERNAL_SERVER_ERROR;
            $error = $error ?: trans('httpstatus.' . HTTP_INTERNAL_SERVER_ERROR);

            return Response::json([
                'code' => $code,
                'error' => $error,
                'data' => $data,
            ], $code);
        });
    }
}
