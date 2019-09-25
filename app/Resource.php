<?php

namespace App;

use App\Http\Traits\CalendarTrait;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Resource extends Model
{
    use CalendarTrait, SearchableTrait;

    const ADD_FILE = '2';
    const NEW_RESOURCE = '1';
    const DOCUMENT = 'Article';
    const AUDIO = 'Audio';
    const VIDEO = 'Video';

    protected $searchable = [
        'columns' => [
            'title' => 1
        ],
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'publication', 'paid', 'published_at' 
    ];

    /**
     * Get the resource file(s) belonging to this resource
     */
    public function resourceFiles()
    {
        return $this->hasMany(ResourceFile::class);
    }

    /**
     * Get the a readable date format
     * 
     * @return string 
     */
    public function getPublishedDate()
    {
        $date = explode('-', explode(' ', $this->created_at)[0]);

        return $this->formatDate($date[0], $date[1], $date[2]);
    }
}
