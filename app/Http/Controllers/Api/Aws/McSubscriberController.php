<?php

namespace App\Http\Controllers\Api\Aws;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AbstractController;
use App\Services\Api\File\McSubscriberService;

class McSubscriberController extends AbstractController
{
    /**
     * @var subscribeService
     */
    private $mcSubscriberService;

    /**
     * ClosetController constructor.
     * @param McSubscriberService $mcSubscriberService
     */
    public function __construct(McSubscriberService $mcSubscriberService) {
        $this->mcSubscriberService = $mcSubscriberService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function subscribe(Request $request)
    {
        $result = $this->mcSubscriberService->handle($request);

        return response()->noContent();
    }
}
