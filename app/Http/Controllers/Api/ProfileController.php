<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\UpdateRequest;
use App\Services\Api\Profile\UpdateService;
use App\Services\Api\Profile\ShowService;
use Illuminate\Http\Request;

class ProfileController extends AbstractController
{
    /**
     * @var UpdateService $updateService
     */
    private $updateService;

    /**
     * @var ShowService $showService
     */
    private $showService;

    /**
     * Create a new controller instance.
     *
     * @param UpdateService $updateService
     * @param ShowService $showService
     */
    public function __construct(
        UpdateService $updateService,
        ShowService $showService
    ) {
        $this->updateService = $updateService;
        $this->showService = $showService;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->apiData = $this->showService->handle($request);

        return $this->success();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        $this->apiData = $this->updateService->handle($request);
        $this->apiMessage = trans('notification.success.update');

        return $this->success();
    }
}
