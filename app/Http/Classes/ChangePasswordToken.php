<?php

namespace App\Http\Classes;

use App\Notifications\ChangePassword;
use Illuminate\Auth\Passwords\PasswordBrokerManager;

class ChangePasswordToken extends PasswordBrokerManager
{
    /**
     * Create password reset token and fire notification event.
     *
     * @param App\User $user
     * @return string
     */
    public function createToken($user)
    {
        $token = $this->createTokenRepository(
            $this->getConfig($this->getDefaultDriver())
        )->create($user);
               
        is_null($token) ?: $user->notify(new ChangePassword($token));

        return $token;
    }
}

