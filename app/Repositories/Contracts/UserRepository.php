<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface UserRepository extends RepositoryInterface
{
    public function createUserTypeSocial($providerName, $userSocial);

    public function getSocialAccount($socialId, $socialName);
}
