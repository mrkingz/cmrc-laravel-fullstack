<?php 

namespace App\Http\Traits;

use App\User;
use App\Activation;
use App\Verification;
use App\Http\Traits\FlashMessageTrait;
use Illuminate\Support\Facades\Hash;

trait ActivationTrait
{
    use FlashMessageTrait;
    /**
     * Activate user account
     * 
     * @param int $id
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    protected function activateAccount($id, $token)
    {
        $user = $this->checkUser($id);

        // We need to make sure user exists and token is valid
        if (is_null($user)) {
            $this->flashMessage('error', 'messages.link', true);
        }  else if ( $user->isActivated($user)) {
            $this->flashMessage('info', 'messages.active', true);
        } else if (! $this->checkToken($user,  $token)) {
            $this->flashMessage('error', 'messages.link', true);
        } else {
            // Update user to activated
            $user->active = User::ACTIVATED;

            $user->save();

            $this->delete($user->activation->user_id);

            $this->flashMessage('success', 'messages.activated', true);
        }

        return redirect('/login');
    }

    /**
     * Determine if user id is valid
     * 
     * @param int $id
     * @return App\User
     */
    protected function checkUser($id)
    {
        return User::with('activation')->find($id);
    }

    /**
     * Determine if the request token is valid
     * 
     * @param App\User $user
     * @param string $token
     * @return bool
     */
    protected function checkToken($user, $token)
    {
        return is_null($user->activation)  
                ? false : hash::check($token, $user->activation->token);
    }

    /**
     * Delete user activation record
     *
     * @param int $id
     * @return void
     */
    protected function delete($id) 
    {
        Activation::where('user_id', $id)->delete();
    }
}