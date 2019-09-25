<?php

namespace App\Http\Traits;

use App\Note;

trait NoteTrait
{
    /**
     * Create a note record in storage
     * 
     * @param array $data
     * @param int $order_id
     */
    protected function createNote(array $data, $order_id)
    {
        return Note::create([
                'note' => $data['note'],
                'order_id' => $order_id
            ]);
    }
}