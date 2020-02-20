<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\File\ShowService;
use Illuminate\Http\Request;
use App\Http\Resources\FileResource;

class FileController extends Controller
{
    /**
     * @var showService
     */
    private $showService;

    /**
     * UserController constructor.
     * @param UploadService $uploadService
     */
    public function __construct(ShowService $showService) 
    {
        $this->showService = $showService;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function show(Request $request, $id)
    {
        $file = $this->showService->handle($request, $id);
        if($request->ajax()) {
            return response()->success(new FileResource($file));
        }
        return view('file.show', compact('file'));
    }
}
