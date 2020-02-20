<?php

namespace App\Exceptions\Api;

class NotFoundException extends ApiException
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = null, $code = HTTP_NOT_FOUND)
    {
        $message = $message ? $message : trans('httpstatus.' . HTTP_NOT_FOUND);

        parent::__construct($message, $code);
    }
}
