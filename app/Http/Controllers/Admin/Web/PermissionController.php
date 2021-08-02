<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Permission\CreateRequest;
use App\Http\Requests\Web\Permission\UpdateRequest;
use Illuminate\Http\Request;
use App\Services\Web\Permission\ListService;
use App\Services\Web\Permission\CreateService;
use App\Services\Web\Permission\EditService;
use App\Services\Web\Permission\DestroyService;
use App\Services\Web\Permission\UpdateService;
use App\Services\Web\Permission\StoreService;

class PermissionController extends Controller
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
     * @var StoreService
     */
    private $storeService;

    /**
     * Create a new controller instance.
     *
     * @param PermissionService $permissionService
     */
    public function __construct(
        ListService $listService,
        CreateService $createService,
        EditService $editService,
        UpdateService $updateService,
        DestroyService $destroyService,
        StoreService $storeService
    ) {
        $this->listService = $listService;
        $this->createService = $createService;
        $this->editService = $editService;
        $this->updateService = $updateService;
        $this->destroyService = $destroyService;
        $this->storeService = $storeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = $this->listService->handle($request);

        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.permission.create');
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
     * @param  \App\Models\Permission  $permission
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
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $permission = $this->editService->handle($request);

        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
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
     * @param  \App\Models\Permission  $permission
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
