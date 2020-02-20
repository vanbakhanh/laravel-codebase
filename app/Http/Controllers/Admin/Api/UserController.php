<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Api\AbstractController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\User\UpdateRequest;
use App\Http\Requests\Api\Admin\User\CreateRequest;
use App\Services\Api\Admin\User\ListService;
use App\Services\Api\Admin\User\CreateService;
use App\Services\Api\Admin\User\UpdateService;
use App\Services\Api\Admin\User\ShowService;
use App\Services\Api\Admin\User\DestroyService;
use Illuminate\Http\Request;

class UserController extends AbstractController
{
    /**
     * @var ListService
     */
    private $listService;

    /**
     * @var CreateService
     */
    private $createService;

    /**
     * @var ShowService
     */
    private $showService;

    /**
     * @var UpdateService
     */
    private $updateService;

    /**
     * @var DestroyService
     */
    private $destroyService;

    /**
     * Create a new controller instance.
     *
     * @param ListService $userService
     * @param CreateService $userService
     * @param ShowService $userService
     * @param UpdateService $userService
     * @param DestroyService $userService
     */
    public function __construct(
        ListService $listService,
        CreateService $createService,
        ShowService $showService,
        UpdateService $updateService,
        DestroyService $destroyService
    )
    {
        $this->listService = $listService;
        $this->createService = $createService;
        $this->showService = $showService;
        $this->updateService = $updateService;
        $this->destroyService = $destroyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->apiData = $this->listService->handle($request);

        return $this->success();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Api\Admin\User\CreateRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $this->apiData = $this->createService->handle($request);

        return $this->success();
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
     * @param  App\Http\Requests\Api\Admin\User\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->apiData = $this->updateService->handle($request);

        return $this->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->apiData = $this->destroyService->handle($request);

        return $this->success();
    }
}
