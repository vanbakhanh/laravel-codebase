<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UpdateRequest;
use App\Services\Api\User\ShowService;
use App\Services\Api\User\UpdateService;
use Illuminate\Http\Request;

class UserController extends AbstractController
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(UpdateRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
