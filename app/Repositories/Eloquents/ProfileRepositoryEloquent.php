<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ProfileRepository;
use App\Models\Profile;
use App\Validators\ProfileValidator;

/**
 * Class ProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ProfileRepositoryEloquent extends AbstractRepositoryEloquent implements ProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Profile::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
