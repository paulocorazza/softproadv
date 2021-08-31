<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = 'events';

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
        'audience',
        'id_google_calendar'
    ];


    public function getStartAttribute($value)
    {
        $dataStart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
        $timeStart = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

        return $this->start = ($timeStart == '00:00:00') ? $dataStart : $value;
    }

    public function getEndAttribute($value)
    {
        $dateEnd = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
        $timeEnd = Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('H:i:s');

        return $this->end = ($timeEnd == '00:00:00') ? $dateEnd : $value;
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
        return $this->belongsToMany(User::class, 'event_users','event_id', 'user_id');
    }


    public function scopeSchedule($query)
    {
        return $query->where('schedule', true);
    }

    public function hasSchedule()
    {
        return $this->schedule;
    }

    public function hasGoogleIntegration()
    {
        return !empty($this->id_google_calendar);
    }

}
