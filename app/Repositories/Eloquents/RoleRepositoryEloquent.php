<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Criteria\RoleCriteria;
use App\Repositories\Contracts\RoleRepository;
use Spatie\Permission\Models\Role;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
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
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RoleCriteria::class));
    }
}
