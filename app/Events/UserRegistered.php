<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

class UserRegistered
{
    use SerializesModels;

    /**
     * Instance of User.
     *
     * @var App\User
     */
    public $user;

    /**
     * Create a new event instance.
     * 
     * @param  \App\User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
