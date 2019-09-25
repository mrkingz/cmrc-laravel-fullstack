<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceFile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_name', 'resource_id' //, 'extension'
    ];

    /**
     * Get the resource the resource file(s) belongs to
     */
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
