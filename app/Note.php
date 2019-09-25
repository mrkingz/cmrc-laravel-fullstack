<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note', 'order_id' 
    ];

    /**
     * Get the order that is associated with this note
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
