<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventFileDownload extends Controller
{
    public function __invoke($id, Event $file)
    {
        $file = $file->find($id);

        $path = public_path() . "/storage/tenants/events/{$file->file}";

        return response()->download($path);
    }
}
