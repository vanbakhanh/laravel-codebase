<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\File\FileService;
use Illuminate\Http\Request;
use App\Http\Resources\FileResource;

class FileController extends Controller
{
    /**
     * @var fileService
     */
    private $fileService;

    /**
     * UserController constructor.
     * @param FileService $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function show(Request $request, $id)
    {
        $file = $this->fileService->show($request, $id);

        if ($request->ajax()) {
            return response()->success(new FileResource($file));
        }

        return view('file.show', compact('file'));
    }
}
