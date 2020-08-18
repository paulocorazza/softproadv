<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Models\ProcessFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProcessFileDestroy extends Controller
{
    public function __invoke(ProcessFiles $file, Request $request)
    {
        if ($request->ajax()) {
            $id = request()->get('id');

            $file = $file->find($id);


            if ($file) {
                $path = public_path() . "/storage/tenants/{$file->file}";

                Storage::delete($file->file);

                $file->delete();

                return response()->json(['result' => true]);
            }
        }
    }
}
