<?php

namespace Saeedvir\SocialiteSlim\Two;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Arr;

class TelegramProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = [];

    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://oauth.telegram.org/auth', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://oauth.telegram.org/auth';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://api.telegram.org/bot'.$this->clientId.'/getMe', [
            RequestOptions::QUERY => [
                'access_token' => $token,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        $userData = Arr::get($user, 'result', []);

        return (new User)->setRaw($userData)->map([
            'id' => Arr::get($userData, 'id'),
            'nickname' => Arr::get($userData, 'username'),
            'name' => trim(Arr::get($userData, 'first_name').' '.Arr::get($userData, 'last_name')),
            'email' => null,
            'avatar' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}