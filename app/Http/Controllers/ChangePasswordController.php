<?php

namespace App\Http\Controllers;

use App\Http\Traits\ChangePasswordTrait;
use App\Http\Classes\ChangePasswordToken;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ChangePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Change Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password change requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords, ChangePasswordTrait; 

    /**
     * Insatnce of App\Http\Classes\ChangePasswordToken
     * 
     * @var $token
     */
    protected $tokenInstance;

    /**
     * Create a new controller instance.
     *
     * @param App\Http\Classes\ChangePasswordToken $tokenInstance
     * @return void
     */
    public function __construct(ChangePasswordToken $tokenInstance)
    {
        $this->tokenInstance = $tokenInstance;

        $this->middleware('auth')->only('changePasswordForm');
    }

    /**
     * Show the form for submitting current password.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePasswordForm() 
    {
        return view('auth.passwords.change');
    }
}
