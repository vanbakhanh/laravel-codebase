<?php

namespace App\Services\Web\FcmNotification;

use App\Exceptions\Api\BadRequestException;
use App\Repositories\Contracts\FcmNotificationRepository;
use App\Services\AbstractService;

class DeleteService extends AbstractService
{
    /**
     * @var FcmNotificationRepository
     */
    private $repository;

    /**
     * DeleteService constructor.
     *
     * @param FcmNotificationRepository $repository
     */
    public function __construct(FcmNotificationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Delete notification.
     *
     * @return boolean
     */
    public function handle($request)
    {
        return $this->transaction(function () use ($request) {
            $notification = $this->repository
                ->makeModel()
                ->where('id', $request->route('notification'))
                ->first();

            if (empty($notification)) {
                throw new BadRequestException('This notification not found.');
            }

            $notification->delete();
        });
    }
}
