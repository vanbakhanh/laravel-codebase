<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\File\UploadRequest;
use App\Services\Api\File\UploadService;
use App\Services\Api\File\UploadImageService;
use App\Services\Api\File\UploadVideoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AbstractController;
use App\Http\Resources\FileResource;
use App\Http\Resources\ImageResource;

class FileController extends AbstractController
{
    /**
     * @var uploadService
     */
    private $uploadService;

    /**
     * @var uploadImageService
     */
    private $uploadImageService;

    /**
     * @var uploadVideoService
     */
    private $uploadVideoService;

    /**
     * UserController constructor.
     * @param UploadService $uploadService
     */
    public function __construct(UploadService $uploadService, 
        UploadImageService $uploadImageService,
        UploadVideoService $uploadVideoService) 
    {
        $this->uploadService = $uploadService;
        $this->uploadImageService = $uploadImageService;
        $this->uploadVideoService = $uploadVideoService;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function upload(UploadRequest $request)
    {
        $uploadedFile = $request->file('file');
        $extension = strtolower(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_EXTENSION));
        if (is_image($extension)) {
            $image = $this->uploadImageService->handle($request);
            if (!$image) {
                return $this->error("Server error.");
            }
            return $this->success(new ImageResource($image));
        } else if (is_video($extension)) {
            $video = $this->uploadVideoService->handle($request);
            if (!$video) {
                return $this->error("Server error.");
            }
            return $this->success(new FileResource($video));
        } else {
            $file = $this->uploadService->handle($request);
            if (!$file) {
                return $this->error("Server error.");
            }
            return $this->success(new FileResource($file));
        }
    }
}
