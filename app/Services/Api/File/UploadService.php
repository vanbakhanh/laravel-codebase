<?php
namespace App\Services\Api\File;

use App\Repositories\Contracts\FileRepository;
use App\Services\AbstractService;

use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Storage;

class UploadService extends AbstractService
{
    /**
     * @var FileRepository
     */
    private $repository;

    /**
     * CreateService constructor.
     * @param FileRepository $repository
     */
    public function __construct(FileRepository $repository)
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
        $fileName = generate_filename($extension);
        $directory = get_upload_folder($extension);
        $path = $directory . '/' . $fileName;

        // upload to s3
        $filePath = $uploadedFile->getRealPath();
        $disk = Storage::disk('s3');
        $uploader = new MultipartUploader($disk->getDriver()->getAdapter()->getClient(), $filePath, [
            'bucket' => config('filesystems.disks.s3.bucket'),
            'key'    => $path,
        ]);

        try {
            $result = $uploader->upload();
        } catch (MultipartUploadException $e) {
            \Log::info($e->getMessage());
            return false;
        }

        // add new record
        $file = $this->repository->create([
            'user_id' => user()->id,
            'path' => $path,
            'extension' => $extension,
            'mime' => guess_mime_type($extension),
            'data' => null,
            'type' => get_file_type($extension)
        ]);

        return $file;
    }
}
