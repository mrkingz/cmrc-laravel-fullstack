<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Session;

trait FlashMessageTrait
{
    /**
     * Create flash message
     * 
     * @param string $type
     * @param string $messageKey
     * @param bool $flush
     * @return void
     */
    protected function flashMessage($type, $messageKey, $flush = false)
    {
        if ($flush) {
            Session::flush();
        }
        Session::flash($type, trans($messageKey));
    }
}