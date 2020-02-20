<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\Admin\CreateRequest;
use App\Http\Requests\Web\User\UpdateRequest;
use Illuminate\Http\Request;
use App\Services\Web\User\ListService;
use App\Services\Web\User\CreateService;
use App\Services\Web\User\ShowService;
use App\Services\Web\User\DestroyService;
use App\Services\Web\User\UpdateService;

class UserController extends Controller
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
     * @param UserService $userService
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
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        if (!$this->createService->handle($request)) {
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
        $user = $this->showService->handle($request);

        return view('admin.user.edit', compact('user'));
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
