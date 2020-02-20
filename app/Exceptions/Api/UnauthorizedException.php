<?php

namespace App\Exceptions\Api;

class UnauthorizedException extends ApiException
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = null, $code = HTTP_UNAUTHORIZED)
    {
        $message = $message ? $message : trans('httpstatus.' . HTTP_UNAUTHORIZED);

        parent::__construct($message, $code);
    }
}
