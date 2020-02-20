<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

abstract class AbstractController extends Controller
{
    /**
     * Data response.
     *
     * @var array|string
     */
    protected $apiData = null;

    /**
     * Message response.
     *
     * @var string
     */
    protected $apiMessage = null;

    /**
     * Render success response.
     *
     * @param array $data
     * @param int $code
     * @return Response
     */
    protected function success($success = null, $data = null, $code = HTTP_OK)
    {
        $data = $data ?: $this->apiData;
        $success = $success ?: $this->apiMessage;

        return response()->success($success, $data, $code);
    }

    /**
     * Render error response.
     *
     * @param array|string $error
     * @param int $code
     * @return Response
     */
    protected function error($error = null, $data = null, $code = HTTP_INTERNAL_SERVER_ERROR)
    {
        $data = $data ?: $this->apiData;
        $error = $error ?: $this->apiMessage;

        return response()->error($error, $data, $code);
    }
}
