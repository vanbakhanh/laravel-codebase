<?php

namespace App\Services\Api\FcmNotification;

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
     * Get list all notification.
     *
     * @return array
     */
    public function handle($request)
    {
        $model = $this->repository->makeModel()
            ->with(['senderProfile'])
            ->where('receiver_id', user()->id);

        if (isset($request['status'])) {
            $model = $model->where('status', $request['status']);
        }

        $notifications = $model->latest()->paginate(config('constants.pagination'));

        return $notifications;
    }
}
