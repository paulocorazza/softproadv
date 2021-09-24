<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStateMonitor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'state_id', 'id_pusher', 'monitoring'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
