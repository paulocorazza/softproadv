<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeAddress extends Model
{
    protected $fillable = ['description'];


    public function rules($id = '')
    {
        return [
            'description'   => 'required|min:3|max:100',
        ];
    }
}
