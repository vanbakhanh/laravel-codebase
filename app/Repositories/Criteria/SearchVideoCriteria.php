<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SearchVideoCriteria.
 *
 * @package namespace App\Criteria;
 */
class SearchVideoCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    private $input;

    /**
     * SearchVideoCriteria constructor.
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
        if (! empty($this->input['user_id'])) {
            $model = $model->where('user_id', (int) $this->input['user_id']);
        }

        if (! empty($this->input['processed'])) {
            $model = $model->where('processed', (int) $this->input['processed']);
        }

        return $model;
    }
}
