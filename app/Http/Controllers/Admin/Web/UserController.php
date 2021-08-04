<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\CreateRequest;
use App\Http\Requests\Web\User\UpdateRequest;
use Illuminate\Http\Request;
use App\Services\Web\User\ListService;
use App\Services\Web\User\StoreService;
use App\Services\Web\User\EditService;
use App\Services\Web\User\DestroyService;
use App\Services\Web\User\UpdateService;
use App\Services\Web\User\CreateService;

class UserController extends Controller
{
    /**
     * @var CreateService
     */
    private $createService;

    /**
     * @var ListService
     */
    private $listService;

    /**
     * @var StoreService
     */
    private $storeService;

    /**
     * @var EditService
     */
    private $editService;

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
     * @param UserService $userService
     */
    public function __construct(
        CreateService $createService,
        ListService $listService,
        StoreService $storeService,
        EditService $editService,
        UpdateService $updateService,
        DestroyService $destroyService
    ) {
        $this->createService = $createService;
        $this->listService = $listService;
        $this->storeService = $storeService;
        $this->editService = $editService;
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
        $users = $this->listService->handle($request);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.user.create', $this->createService->handle($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        if (!$this->storeService->handle($request)) {
            return back()->withInput()->with('error', trans('notification.fail.create'));
        }

        return back()->with('success', trans('notification.success.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return view('admin.user.edit', $this->editService->handle($request));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        if (!$this->updateService->handle($request)) {
            return back()->withInput()->with('error', trans('notification.fail.update'));
        }

        return back()->with('success', trans('notification.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$this->destroyService->handle($request)) {
            return back()->withInput()->with('error', trans('notification.fail.delete'));
        }

        return back()->with('success', trans('notification.success.delete'));
    }
}
