<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserView extends Model
{
    protected $fillable = ['user_id', 'user_id_view'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userView()
    {
        return $this->belongsTo(User::class, 'user_id_view', 'id');
    }
}
