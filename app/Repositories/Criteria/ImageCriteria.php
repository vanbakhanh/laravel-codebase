<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ImageCriteria.
 *
 * @package namespace App\Criteria;
 */
class ImageCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $input;

    /**
     * ImageCriteria constructor.
     * @param array $input
     */
    public function __construct($input = [])
    {
        $this->input = $input;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        
        $model = $model->where('type', config('constants.file_type.image'));

        return $model;
    }
}
