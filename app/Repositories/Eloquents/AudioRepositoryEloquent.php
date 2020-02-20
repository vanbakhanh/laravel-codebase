<?php

namespace App\Repositories\Eloquents;

use App\Models\Audio;
use App\Repositories\Contracts\AudioRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Criteria\AudioCriteria;

/**
 * Class AudioRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class AudioRepositoryEloquent extends FileRepositoryEloquent implements AudioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Audio::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(app(AudioCriteria::class));
    }
}
