<?php

namespace App\Http\Classes;

use App\User;
use App\Activation;
use App\Http\Traits\TokenTrait;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AccountActivation;

class ActivationToken
{
    use  TokenTrait;

    /**
     * Save activation token and fire notification event.
     *
     * @param App\User $user
     * @return void 
     */
    public function createToken($user)
    {
        $token = $this->generateToken();

        $response = Activation::create([
            'user_id' => $user->id,
            'token' => hash::make($token),
        ]);
        
        is_null($response) ?: $user->notify(new AccountActivation($token));
    }
}

