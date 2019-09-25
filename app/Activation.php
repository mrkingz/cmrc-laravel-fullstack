<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'token',
    ];
    
    /**
     * Get the user that owns the activation record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setUpdatedAt($value)
    {
        //
    }
}
