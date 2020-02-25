<?php

namespace App\Services\Web\FcmNotification;

use App\Repositories\Contracts\FcmNotificationRepository;
use App\Services\AbstractService;

class CountService extends AbstractService
{
    /**
     * @var FcmNotificationRepository
     */
    private $repository;

    /**
     * CountService constructor.
     *
     * @param FcmNotificationRepository $repository
     */
    public function __construct(FcmNotificationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Count notification.
     */
    public function handle($request)
    {
        return $this->repository
            ->makeModel()
            ->where('receiver_id', user()->id)
            ->where('status', config('model.notification.unread'))
            ->count();
    }
}
