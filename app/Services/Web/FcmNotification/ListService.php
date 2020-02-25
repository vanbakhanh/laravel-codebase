<?php

namespace App\Services\Web\FcmNotification;

use App\Repositories\Contracts\FcmNotificationRepository;
use App\Services\AbstractService;

class ListService extends AbstractService
{
    /**
     * @var FcmNotificationRepository
     */
    private $repository;

    /**
     * ListService constructor.
     *
     * @param FcmNotificationRepository $repository
     */
    public function __construct(FcmNotificationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function handle($request)
    {
        $model = $this->repository
            ->makeModel()
            ->with('senderProfile')
            ->latest();

        if (isset($request['receiver_id'])) {
            $model = $model->where('receiver_id', $request['receiver_id']);
        }

        if (isset($request['status'])) {
            $model = $model->where('status', $request['status']);
        }

        return $model->paginate(config('constants.pagination'));
    }
}
