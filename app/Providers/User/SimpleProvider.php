<?php

namespace App\Providers\User;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class SimpleProvider implements UserProvider
{
    private GenericUser $user;

    public function __construct()
    {
        $this->user = new GenericUser([
            'id' => 'otong',
            'name' => 'Otong',
            'token' => 'rahasia'
        ]);
    }

    public function retrieveByCredentials(array $credentials)
    {
        if ($credentials['token'] == $this->user->token) {
            return $this->user;
        }

        return null;
    }

    public function retrieveById($identifier)
    {
    }

    public function retrieveByToken($identifier, $token)
    {
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
    }
}
