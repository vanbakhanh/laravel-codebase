<?php

namespace App\Repositories\Eloquents;

use App\Models\Image;
use App\Repositories\Contracts\ImageRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Criteria\ImageCriteria;

/**
 * Class ImageRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ImageRepositoryEloquent extends FileRepositoryEloquent implements ImageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Image::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(app(ImageCriteria::class));
    }
}
