<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'code',
    ];

    /**
     * Get the user that owns the verification record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
