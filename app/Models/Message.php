<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    use HasFactory;

    protected $fillable = ['message'];

    protected $appends= ['datetime_br'];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function getDatetimeBrAttribute()
    {
       return Helper::formatDateTime($this->created_at);
    }


}
