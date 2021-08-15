<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class UserRepositoryEloquent extends AbstractRepositoryEloquent implements UserRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'profile.first_name',
        'profile.last_name',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Create user by social information.
     *
     * @param string $providerName
     * @param object $userSocial
     * @return object
     */
    public function createUserTypeSocial($providerName, $userSocial)
    {
        $name = $this->splitName($userSocial->getName());

        $user = $this->model->firstOrCreate([
            'social_id' => $userSocial->getId(),
            'social_name' => $providerName,
        ]);

        $user->profile()->create([
            'first_name' => $name['first_name'],
            'last_name' => $name['last_name'],
            'avatar' => $userSocial->getAvatar(),
        ]);

        return $user;
    }

    /**
     * Get user by social information.
     *
     * @param string $socialId
     * @param string $socialName
     * @return object
     */
    public function getSocialAccount($socialId, $socialName)
    {
        return $this->findWhere([
            'social_id' => $socialId,
            'social_name' => $socialName,
        ])->first();
    }

    /**
     * Split full name to first name and last name.
     *
     * @param string $name
     * @return array
     */
    private function splitName($name)
    {
        $nameArray = explode(' ', $name);
        $firstName = isset($nameArray[0]) ? $nameArray[0] : ' ';
        unset($nameArray[0]);
        $lastName = implode(' ', $nameArray);

        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
        ];
    }
}
