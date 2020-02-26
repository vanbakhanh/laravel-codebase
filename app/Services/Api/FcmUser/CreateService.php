<?php

namespace App\Services\Api\FcmUser;

use App\Repositories\Contracts\FcmUserRepository;
use App\Services\AbstractService;

class CreateService extends AbstractService
{
    /**
     * @var FcmUserRepository
     */
    private $repository;

    /**
     * CreateService constructor.
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
    public function handle($request)
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
}
