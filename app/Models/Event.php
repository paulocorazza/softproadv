<?php

namespace App\Models;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $appends = [
        'start_br', 'end_br'
    ];

    protected $fillable = [
        'user_id',
        'title',
        'start',
        'end',
        'color',
        'description',
        'process_id',
        'schedule',
        'finish',
        'file',
    ];


    public function getStartBrAttribute()
    {
        return Helper::formatDateTime($this->start, 'd/m/Y H:i:s');
    }

    public function getEndBrAttribute()
    {
        return Helper::formatDateTime($this->end, 'd/m/Y H:i:s');
    }


    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'event_users');
    }

    public function rules()
    {
        return [
            'user_id'       => 'required|exists:users,id',
            'title'         => 'required|min:3',
            'start'         => 'date|before:end',
            'end'           => 'date|after:start',
            'process_id'    => 'nullable|exists:processes,id'
        ];
    }

    public function getDaysDiffAttribute()
    {
        $hoje = Carbon::now();
        $end = Carbon::parse($this->end);

        $diff =  $hoje->diff($end);
        return $diff->d . 'd ' . $diff->h . 'h ' . $diff->m . 'm' ;
    }

    public function scopeSchedule($query)
    {
        return $query->where('schedule', true);
    }

    public function scopePending($query)
    {
        return $query->whereNull('finish');
    }

    public function scopeFinish($query)
    {
        return $query->whereNotNull('finish');
    }
}
