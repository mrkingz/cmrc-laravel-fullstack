<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\FlashMessageTrait;
use Illuminate\Support\Facades\Session;

trait ChangePasswordTrait 
{
    use FlashMessageTrait;

    /**
     * Verifies the authenticated user password
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {

            $this->tokenInstance->createToken($user);

            $this->flashMessage('success', 'passwords.sent');

            return back();
            
        } else {
            return back()->withErrors(['password' => trans('messages.password.invalid')]);
        } 
    }
}