<?php

namespace App\Models;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'user_id',
        'title',
        'start',
        'end',
        'color',
        'description',
        'process_id',
        'schedule',
        'allday',
        'finish',
        'file',
    ];


   /* public function getStartAttribute($value)
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
*/
    public function getStartAttribute($value)
    {
        return Helper::formatDateTime($value, 'd/m/Y H:i:s');
    }

    public function getEndAttribute($value)
    {
        return Helper::formatDateTime($value, 'd/m/Y H:i:s');
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
            'user_id'   => 'required|exists:users,id',
            'title'     => 'required|min:3',
            'start' => 'date|before:end',
            'end' => 'date|after:start',
        ];
    }

    public function scopeSchedule($query)
    {
        return $query->where('schedule', true);
    }
}
