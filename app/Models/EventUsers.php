<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUsers extends Model
{
    protected $fillable = ['user_id', 'event_id'];
}
