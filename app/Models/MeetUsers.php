<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetUsers extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'meet_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }
}
