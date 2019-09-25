<?php

namespace App;

use App\Http\Traits\CalendarTrait;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use CalendarTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'testimony',
    ];

    /**
     * Get the user that is associated with this testimony.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormatedDate()
    {
        $date = explode(' ', $this->created_at)[0];

        $date = explode('-', $date);

        return $this->formatDate($date[0], $date[1], $date[2]);
    }
}
