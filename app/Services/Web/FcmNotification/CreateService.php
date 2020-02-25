<?php

namespace App\Services\Web\FcmNotification;

use App\Repositories\Contracts\FcmNotificationRepository;
use App\Services\AbstractService;

class CreateService extends AbstractService
{
    /**
     * @var FcmNotificationRepository
     */
    private $repository;

    /**
     * CreateService constructor.
     *
     * @param FcmNotificationRepository $repository
     */
    public function __construct(FcmNotificationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create fcm notification.
     */
    public function handle($request)
    {
        $input = $request->only($this->repository->getFillable());
        $input['status'] = config('model.notification.unread');

        return $this->transaction(function () use ($request, $input) {
            return $this->repository->create($input);
        });
    }
}
