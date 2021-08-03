<?php

namespace App\Models;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProcessProgress extends Model
{
    protected $table = 'process_progresses';

    protected $casts = [
        'date_br' => 'date',
        'date_term_br' => 'date',
    ];


    protected $fillable = [
        'date',
        'date_term',
        'description',
        'publication',
        'concluded',
        'process_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function scopeConcluded($query)
    {
        return $query->where('concluded', true);
    }

    public function scopePending($query)
    {
        return $query->where('concluded', false);
    }


    public function setDateAttribute($input)
    {
        $this->attributes['date'] =
            Carbon::createFromFormat('d/m/Y', $input)->format('Y-m-d');
    }

    public function setDateTermAttribute($input)
    {
        $this->attributes['date_term'] =
            Carbon::createFromFormat('d/m/Y', $input)->format('Y-m-d');
    }


    public function getDateBrAttribute()
    {
        return Helper::formatDateTime($this->date, 'd/m/Y');
    }

    public function getDateTermBrAttribute($value)
    {
        return Helper::formatDateTime($this->date_term, 'd/m/Y');
    }

    public function getDaysDiffAttribute()
    {
        $hoje = Carbon::now();
        $end = Carbon::parse($this->date_term);

        $diff = $hoje->diff($end);
        return $diff->d . 'd ' . $diff->h . 'h ' . $diff->m . 'm';

    }
}
