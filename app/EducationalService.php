<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'field', 'type', 'order_id' 
    ];

    /**
     * Get the order that is associated with to this educational service
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
