<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Classes\VerificationCode;

class VerificationController extends Controller
{
    /**
     * Instance of App\Http\Classes\verificationCode 
     * 
     * @var $verification
     */
    protected $verification;

    /**
     * Create a new controller instance.
     *
     * @param App\Http\Classes\VerificationCode $verification
     * @return void
     */
    public function __construct(VerificationCode $verification) 
    {
        $this->middleware('auth');

        $this->verification = $verification;
    }

    /**
     * Update the specified resource in storage.
     *w
     * @param App\User $user
     * @return string
     */
    protected function update(User $user)
    {
        return $this->verification->resetCode($user);
    }
}
