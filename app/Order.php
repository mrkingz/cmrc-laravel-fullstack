<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const EDUCATIONAL = 'Educational';
    const EMPIRICAL = 'Empirical';
    const PRACTICAL = 'Practical';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category', 'title', 'format', 'pages', 'phone', 'user_id' 
    ];

    /**
     * Get the educational services belonging to this order
     */
    public function educationService()
    {
        return $this->hasOne(EducationService::class);
    }
    

    /**
     * Get the empirical data target belonging to this order
     */
    public function empiricalDatum()
    {
        return $this->hasOne(EmpiricalDatum::class);
    }

    /**
     * Get the files belonging to this order
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * Get the practical research area belonging to this order
     */
    public function practicalResearch()
    {
        return $this->hasOne(PracticalResearch::class);
    }

    /**
     * Get the Note belonging to this order
     */
    public function note()
    {
        return $this->hasOne(Note::class);
    }

    /**
     * Get the user that associated user with these order(s)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
