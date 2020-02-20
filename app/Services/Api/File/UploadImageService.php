<?php

namespace App\Services\Api\File;

use App\Repositories\Contracts\ImageRepository;
use App\Services\AbstractService;

use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File as SupportFile;

class UploadImageService extends AbstractService
{
    /**
     * @var ImageRepository
     */
    private $repository;

    /**
     * CreateService constructor.
     * @param FileRepository $repository
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Illuminate\Http\Request|\Illuminate\Support\Collection $request
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function handle($request)
    {
        $uploadedFile = $request->file('file');
        $extension = strtolower(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_EXTENSION));
        $filePath = $uploadedFile->getRealPath();

        $fileName = generate_filename($extension);
        $directory = get_upload_folder($extension);
        $originPath = $directory . '/' . $fileName;
        $thumbnailPath = $directory . '/thumb-' . $fileName;
        $mobilePath = $directory . '/mobile-' . $fileName;

        // resize first
        $tempPath = '/tmp';
        $resizeImg = Image::make($filePath);
        // backup status
        $resizeImg->backup();
        $resizeData = null;

        try {
            // upload to s3
            $disk = Storage::disk('s3');
            $uploader = new MultipartUploader($disk->getDriver()->getAdapter()->getClient(), $filePath, [
                'bucket' => config('filesystems.disks.s3.bucket'),
                'key'    => $originPath,
            ]);
            $result = $uploader->upload();

            $resizeImg->fit(config('constants.resize.thumbnail.width'), config('constants.resize.thumbnail.height'))
                ->save($tempPath . '/thumb-' . $fileName);
            $thumbUploader = new MultipartUploader($disk->getDriver()->getAdapter()->getClient(), $tempPath . '/thumb-' . $fileName, [
                'bucket' => config('filesystems.disks.s3.bucket'),
                'key'    => $thumbnailPath,
            ]);
            $thumbResult = $thumbUploader->upload();
            $resizeData['thumbnail'] = ['path' => $thumbnailPath];
            // reset image (return to backup state)
            $resizeImg->reset();

            $resizeImg->fit(config('constants.resize.mobile.width'), config('constants.resize.mobile.height'))
                ->save($tempPath . '/mobile-' . $fileName);
            $mobileUploader = new MultipartUploader($disk->getDriver()->getAdapter()->getClient(), $tempPath .  '/mobile-' . $fileName, [
                'bucket' => config('filesystems.disks.s3.bucket'),
                'key'    => $mobilePath,
            ]);
            $mobileResult = $mobileUploader->upload();
            $resizeData['mobile'] = ['path' => $mobilePath];

            SupportFile::delete($tempPath . '/thumb-' . $fileName);
            SupportFile::delete($tempPath . '/mobile-' . $fileName);
        } catch (MultipartUploadException $e) {
            \Log::info($e->getMessage());
            return false;
        }

        // add new record
        $image = $this->repository->create([
            'user_id' => user()->id,
            'path' => $originPath,
            'extension' => $extension,
            'mime' => guess_mime_type($extension),
            'data' => json_encode($resizeData),
            'type' => config('constants.file_type.image')
        ]);

        return $image;
    }
}
