<?php

namespace App\Services\Web\FcmNotification;

use App\Repositories\Contracts\FcmNotificationRepository;
use App\Services\AbstractService;
use App\Exceptions\Api\BadRequestException;

class FcmNotificationService extends AbstractService
{
    /**
     * @var FcmNotificationRepository
     */
    private $repository;

    /**
     * FcmNotificationService constructor.
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
    public function create($request)
    {
        $input = $request->only($this->repository->getFillable());
        $input['status'] = config('model.notification.unread');

        return $this->transaction(function () use ($request, $input) {
            return $this->repository->create($input);
        });
    }

    /**
     * Delete notification.
     *
     * @return boolean
     */
    public function delete($request)
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

    /**
     * List notification.
     * 
     * @return array
     */
    public function list($request)
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

    /**
     * Count notification.
     * 
     * @return int
     */
    public function count($request)
    {
        return $this->repository
            ->makeModel()
            ->where('receiver_id', user()->id)
            ->where('status', config('model.notification.unread'))
            ->count();
    }

    /**
     * Mark as read notification.
     *
     * @return array
     */
    public function markAsRead(array $ids)
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
