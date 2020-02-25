<?php

namespace App\Repositories\Eloquents;

use App\Models\FcmNotification;
use App\Repositories\Contracts\FcmNotificationRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class FcmNotificationRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class FcmNotificationRepositoryEloquent extends AbstractRepositoryEloquent implements FcmNotificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FcmNotification::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
