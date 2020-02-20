<?php

namespace App\Repositories\Eloquents;

use App\Models\File;
use App\Repositories\Contracts\FileRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class FileRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class FileRepositoryEloquent extends AbstractRepositoryEloquent implements FileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return File::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
