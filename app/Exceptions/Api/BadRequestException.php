<?php

namespace App\Exceptions\Api;

class BadRequestException extends ApiException
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = null, $code = HTTP_BAD_REQUEST)
    {
        $message = $message ? $message : trans('httpstatus.' . HTTP_BAD_REQUEST);

        parent::__construct($message, $code);
    }
}
