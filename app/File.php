<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_name', 'order_id'
    ];

    /**
     * Get the order that is associated with this file(s)
     */
    public function order()
    {
        return $this->belongsTo(File::class);
    }
}
