<?php 

namespace App\Subscribers;

use App\Events\VerifiedCode;
use App\Events\UserRegistered;
use App\Http\Classes\ActivationToken;
use App\Http\Classes\VerificationCode;

class RegistrationEventsSubscriber
{
    /**
     * Instance of App\Http\Classes\ActivationToken
     * 
     * @var $activationToken 
     */
    protected $activationToken;

    /**
     * Create instance of RegistrationEventsSubscriber
     * 
     * @param App\Http\Classes\ActivationToken $activationToken
     * @param App\Http\Classes\VerificationCode $verificationCode
     * @return void 
     */
    public function __construct(ActivationToken $activationToken)
    {
        $this->activationToken = $activationToken;
    }

    /**
     * Handle user registered event.
     * 
     * @param App\Events\UserRegistered $event
     */
    public function onUserRegistered(UserRegistered $event)
    {
        $this->activationToken->createToken($event->user);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($event)
    {
        $event->listen(
            'App\Events\UserRegistered',
            'App\Subscribers\RegistrationEventsSubscriber@onUserRegistered'
        );
    }
}