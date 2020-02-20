<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Profile\UpdateRequest;
use App\Services\Web\Profile\ShowService;
use App\Services\Web\Profile\UpdateService;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $profile = $this->showService->handle($request);

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        if (!$this->updateService->handle($request)) {
            return back()->withInput()->with('error', trans('notification.fail.update'));
        }

        return back()->with('success', trans('notification.success.update'));
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
