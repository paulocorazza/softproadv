<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessFiles extends Model
{
    protected $fillable = ['file', 'description', 'ext'];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
