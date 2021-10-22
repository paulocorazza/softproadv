<?php

namespace App\Observers;

use App\Models\Meet;

class MeetObserver
{
    public function creating(Meet $meet)
    {
        $meet->user_id = auth()->user()->id;
    }
}
