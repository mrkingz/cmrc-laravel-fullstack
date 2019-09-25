<?php

namespace App\Http\Classes;

use App\User;
use App\Verification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\VerifiedCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerificationNotification;

class VerificationCode
{
    /**
     * The errore message to display for expired verification code
     */
    const EXPIRED_CODE = 'messages.expired';

    /**
     * The errore message to display for invalid verification code
     */    
    const INVALID_CODE = 'messages.invalid';

    /**
     * The success message to display for a successful verification code resend
     */
    const RESET_CODE = 'messages.resend';

    const NOT_SENT_ERROR = 'Error occured, code not sent! Try again...';

    /**
     * The life span of the verification code, after which it expires
     * 
     * @var $expires
     */
    protected $expires;

    /**
     * The verification code 
     * 
     * @var $code
     */
    protected $code;

    /**
     * Create an instance of VerificationCode
     * 
     *  @return void
     */
    public function __construct()
    {
        $this->expires = config('app.expires');
    }

    /**
     * Determine if code exists and is valid
     * 
     * @param string $code
     * @return string|null
     */
    public function verifyCode($code)
    {
        // We'll check if there's a verification record belonging to the authenticated user
        // Then will compare the code from incoming request with our record 
        // If verification code is valid and not expired, we will return null

        $verification = Verification::where('user_id', Auth::id())->first();
        
        if (isset($verification) && hash::check($code, $verification->code))
        {
            // We have to check if verification code has expired
            if ($this->expiredCode($verification->updated_at)) {
                return $this->response(static::EXPIRED_CODE);
            }

            $this->deleteCode();

            return null;
        }

        return $this->response(static::INVALID_CODE);
    }

    /**
     * Store verification code in storage and send code to phone.
     *
     * @param  App\User $user
     * @return void
     */
    public function createCode($user)
    {
        $this->deleteCode();

        $response = Verification::create([
            'user_id' => $user->id,
            'code' => $this->generateCode()
        ]); 
        
        //If response is not null, then send code to phone
        is_null($response) ?: $this->sendCodeToPhone($user);
    }

    /**
     * Delete the verification record belonging to the verified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCode()
    {
        Verification::where('user_id', Auth::id())->delete();
    }

    /**
     * Determine if the code has expired.
     *
     * @param  string  $createdAt
     * @return bool
     */
    protected function expiredCode($updatedAt)
    {
        return Carbon::parse($updatedAt)->addMinutes($this->expires)->isPast();
    }

    /**
     * Generates a six digit verification code
     *  
     * @return string
     */
    protected function generateCode() 
    {
        $this->code = random_int (100000, 999999);
  
        return hash::make($this->code);
    }

    /**
     * Update the verification code.
     *
     * @param $id
     * @return string
     */
    public function resetCode($user)
    {
        $response = Verification::updateOrCreate(
            ['user_id' => $user->id], 
            ['code' => $this->generateCode()]);
        
        if (! is_null($response)) {
            return $this->sendCodeToPhone($user)
                    ? response(['success' => true, 'message' => static::RESET_CODE])  
                    : response(['success' => false, 'message' => static::NOT_SENT_ERROR]);
        }
    }

    /**
     * Get a specific message response
     *
     * @param string $string
     * @return string
     */
    protected function response($string)
    {
        return trans($string);
    }

    /**
     * Send verification code to phone 
     * 
     * @param App\User $user
     * @return bool
     */
    protected function sendCodeToPhone($user)
    {
        // We will try and catch as protection against network failure
        // If notification was successfully sent, return true
        // Otherwise, catch and return false
        try {
           $user->notify(new VerificationNotification($this->code));
            
            return true;
        } catch(Exception $e) {
            report($e);
        } 
        finally {
            return false;
        }
    }
}