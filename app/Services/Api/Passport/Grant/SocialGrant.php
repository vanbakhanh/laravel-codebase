<?php

namespace App\Services\Api\Passport\Grant;

use Laravel\Passport\Bridge\User;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\PasswordGrant;
use League\OAuth2\Server\RequestEvent;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

/**
 * Social grant class.
 */
class SocialGrant extends PasswordGrant
{
    /**
     * @param ServerRequestInterface $request
     * @param ClientEntityInterface  $client
     *
     * @throws OAuthServerException
     *
     * @return UserEntityInterface
     */
    protected function validateUser(ServerRequestInterface $request, ClientEntityInterface $client)
    {
        $socialId = $this->getRequestParameter('social_id', $request);
        if (is_null($socialId)) {
            throw OAuthServerException::invalidRequest('social_id');
        }

        $socialName = $this->getRequestParameter('social_name', $request);
        if (is_null($socialName)) {
            throw OAuthServerException::invalidRequest('social_name');
        }

        $user = $this->getUserEntityBySocialCredentials($socialName, $socialId);

        if ($user instanceof UserEntityInterface === false) {
            $this->getEmitter()->emit(new RequestEvent(RequestEvent::USER_AUTHENTICATION_FAILED, $request));

            throw OAuthServerException::invalidCredentials();
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return 'social';
    }

    /**
     * {@inheritdoc}
     */
    public function getUserEntityBySocialCredentials($socialName, $socialId)
    {
        $provider = config('auth.guards.api.provider');

        if (is_null($model = config('auth.providers.' . $provider . '.model'))) {
            throw new RuntimeException('Unable to determine authentication model from configuration.');
        }

        $user = (new $model)->where([
            ['social_name', $socialName],
            ['social_id', $socialId],
        ])->first();

        if (!$user) {
            return;
        }

        return new User($user->getAuthIdentifier());
    }
}
