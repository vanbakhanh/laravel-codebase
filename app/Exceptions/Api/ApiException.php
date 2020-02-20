<?php

namespace App\Exceptions\Api;

use Exception;

class ApiException extends Exception
{
    /**
     * Http status code.
     *
     * @var int
     */
    protected $code;

    /**
     * Http status message.
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = null, $code = null)
    {
        if (!$code || !is_numeric($code) || $code <= 0) {
            $code = HTTP_INTERNAL_SERVER_ERROR;
        }

        if (!$message) {
            $message = trans('httpstatus.' . $code);
        }

        $this->message = $message;
        $this->code = $code;

        parent::__construct($message, $code);
    }
}
