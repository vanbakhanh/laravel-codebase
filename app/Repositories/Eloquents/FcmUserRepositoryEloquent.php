<?php

namespace App\Repositories\Eloquents;

use App\Models\FcmUser;
use App\Repositories\Contracts\FcmUserRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class FcmUserRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class FcmUserRepositoryEloquent extends AbstractRepositoryEloquent implements FcmUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FcmUser::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
