<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpiricalDatum extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'target', 'order_id' 
    ];

    /**
     * Get the order that is associated with this emperical data
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
