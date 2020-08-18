<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Models\ProcessFiles;


class ProcessFileView extends Controller
{
    public function __invoke($id, ProcessFiles $file)
    {
        $file = $file->find($id);

        $path = public_path(). "/storage/tenants/{$file->file}";

        return response()->file($path);


    }
}
