<?php

namespace App\Models;

use App\Helpers\Helper;
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
        'finish',
        'file',
    ];


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
            'user_id'       => 'required|exists:users,id',
            'title'         => 'required|min:3',
            'start'         => 'date|before:end',
            'end'           => 'date|after:start',
            'process_id'    => 'nullable|exists:processes,id'
        ];
    }

    public function scopeSchedule($query)
    {
        return $query->where('schedule', true);
    }
}
