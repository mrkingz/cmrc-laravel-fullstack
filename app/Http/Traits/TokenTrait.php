<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;

trait TokenTrait
{
    protected $token;
    /**
     * Create a new token for the user.
     *
     * @return string
     */
    public function generateToken()
    {
        $hashKey = $this->getHashKey();

        if (Str::startsWith($hashKey, 'base64:')) {
            $hashKey = base64_decode(substr($hashKey, 7));
        }

        return $this->token = hash_hmac('sha256', Str::random(40), $hashKey);
    }

    /**
     * Get the configured has key
     * 
     * @return string
     */
    protected function getHashKey()
    {
        return config('app.key');
    }
}