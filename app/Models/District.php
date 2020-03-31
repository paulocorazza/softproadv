<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name'];

    public function rules($id = '')
    {
        return [
            'name' => "required|min:3|max:100|unique:districts,name,{$id},id",
        ];
    }
}
