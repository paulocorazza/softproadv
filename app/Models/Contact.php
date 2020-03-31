<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'cellphone', 'telephone', 'email', 'observation'];


    public function contactable()
    {
        return $this->morphTo();
    }
}
