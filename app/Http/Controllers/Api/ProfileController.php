<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Profile\UpdateRequest;
use App\Services\Api\Profile\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends AbstractController
{
    /**
     * @var ProfileService $profileService
     */
    private $profileService;

    /**
     * Create a new controller instance.
     *
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->apiData = $this->profileService->show($request);

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
        $this->apiData = $this->profileService->update($request);
        $this->apiMessage = trans('notification.success.update');

        return $this->success();
    }
}
