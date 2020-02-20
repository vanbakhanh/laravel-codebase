<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class AbstractRepositoryEloquent extends BaseRepository
{
    /**
     * Get fillable of model.
     *
     * @return array
     */
    public function getFillable()
    {
        return $this->model->getFillable();
    }
}
