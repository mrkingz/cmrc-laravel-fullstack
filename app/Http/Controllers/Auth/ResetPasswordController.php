<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('reset');
    }

    /**
     * Determine where to redirect user after a successful password reset
     * 
     * @return string
     */
    protected function redirectTo()
    {
        $user = $this->guard()->user();

        // If account has not been activated
        // We will redirect user to the login page with a flash message
        // Otherwise we will redirect user to home page
        if (! $user->isActivated()) {
            $this->guard()->logout($user);

            Session::flash('success', trans('messages.reset'));

            $this->redirectTo = '/login';
        }

        return $this->redirectTo;
    }
}
