<?php

namespace App\Repositories\Eloquents;

use App\Models\Video;
use App\Repositories\Contracts\VideoRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Criteria\VideoCriteria;

/**
 * Class VideoRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class VideoRepositoryEloquent extends FileRepositoryEloquent implements VideoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Video::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(app(VideoCriteria::class));
    }
}
