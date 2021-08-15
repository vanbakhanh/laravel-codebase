<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Criteria\PermissionCriteria;
use App\Repositories\Contracts\PermissionRepository;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(PermissionCriteria::class));
    }
}
