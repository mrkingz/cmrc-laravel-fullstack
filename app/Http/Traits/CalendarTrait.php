<?php

namespace App\Http\Traits;

use Illuminate\Support\Carbon;

trait CalendarTrait 
{
    /**
     * Format date to a readable string
     * 
     * @param int $year
     * @param int $month
     * @param int $date
     * @return string
     */
    protected function formatDate($year, $month, $date)
    {
        $dt = Carbon::create($year, $month, $date);

        return $dt->format('jS F\\, Y');
    }

    /**
     * Format time to a readable string
     * 
     * @param int $hour
     * @param int $min
     * @param int $sec
     * @return string
     */
    protected function formatTime($hour, $min ,$sec)
    {
        $dt = Carbon::create($hour, $min, $sec);

        return $dt->format('h:i A');
    }
}