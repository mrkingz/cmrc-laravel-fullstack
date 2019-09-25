<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    const NOT_ACTIVATED = 0;

    const ACTIVATED = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the activation record associated with the user.
     */
    public function activation()
    {
        return $this->hasOne(Activation::class);
    }

    /**
     * Determine if account has been activated
     * 
     * @return bool  
     */
    public function isActivated() 
    {
        return $this->active == static::ACTIVATED;
    }

    /**
     * Get the orders belonging to this user
     */
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {   
        return $this->phone = is_null(session('order')) ?: session()->get('order.data.phone');
    }

    /**
     * Get the testimony associated with the user.
     */
    public function testimony()
    {
        return $this->hasOne(Testimony::class);
    }

    /**
     * Get the verification record associated with the user.
     */
    public function verification()
    {
        return $this->hasOne(Verification::class);
    }  
}
