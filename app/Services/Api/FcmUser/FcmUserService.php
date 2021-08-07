<?php

namespace App\Services\Api\FcmUser;

use App\Repositories\Contracts\FcmUserRepository;
use App\Services\AbstractService;

class FcmUserService extends AbstractService
{
    /**
     * @var FcmUserRepository
     */
    private $repository;

    /**
     * FcmUserService constructor.
     *
     * @param FcmUserRepository $repository
     */
    public function __construct(FcmUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create fcm user.
     */
    public function create($request)
    {
        $token = $request->get('fcm_token');

        $fcmUser = $this->repository->findByField('token', $token);

        if ($fcmUser !== null && $fcmUser->user_id !== user()->id) {
            $fcmUser->delete();
            $fcmUser = null;
        }

        if ($fcmUser === null) {
            $data = $request->only($this->repository->getFillable());

            $fcmUser = $this->transaction(function () use ($data) {
                return $this->repository->create($data);
            });
        }

        return $fcmUser;
    }

    /**
     * Delete fcm user.
     */
    public function delete($request)
    {
        $token = $request->get('fcm_token');

        return $this->transaction(function () use ($token) {
            return $this->repository->findWhere(['token' => $token])->delete();
        });
    }
}
