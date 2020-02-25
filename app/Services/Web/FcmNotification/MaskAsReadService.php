<?php

namespace App\Services\Web\FcmNotification;

use App\Repositories\Contracts\FcmNotificationRepository;
use App\Services\AbstractService;

class MaskAsReadService extends AbstractService
{
    /**
     * @var FcmNotificationRepository
     */
    private $repository;

    /**
     * MaskAsReadService constructor.
     *
     * @param FcmNotificationRepository $repository
     */
    public function __construct(FcmNotificationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Mark as read notification.
     *
     * @return array
     */
    public function handle(array $ids)
    {
        return $this->transaction(function () use ($ids) {
            $this->repository
                ->makeModel()
                ->whereIn('id', $ids)
                ->where('receiver_id', user()->id)
                ->update([
                    'status' => config('model.notification.read'),
                ]);
        });
    }
}
