<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Api\AbstractController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\User\UpdateRequest;
use App\Http\Requests\Api\Admin\User\CreateRequest;
use App\Services\Api\Admin\User\UserService;
use Illuminate\Http\Request;

class UserController extends AbstractController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->apiData = $this->userService->list($request);

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
        $this->apiData = $this->userService->store($request);

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
        $this->apiData = $this->userService->show($request);

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
        $this->apiData = $this->userService->update($request);

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
        $this->apiData = $this->userService->delete($request);

        return $this->success();
    }
}
