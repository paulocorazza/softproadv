<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessProgress extends Model
{
    protected $fillable = [
        'date',
        'date_term',
        'description',
        'publication',
        'pending',
        'process_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
