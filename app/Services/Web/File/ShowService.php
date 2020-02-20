<?php
namespace App\Services\Web\File;

use App\Repositories\Contracts\FileRepository;
use App\Services\AbstractService;

class ShowService extends AbstractService
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
    public function handle($request, $fileId)
    {
        return $this->repository->find($fileId);
    }
}
