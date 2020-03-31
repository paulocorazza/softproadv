<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['name'];

    public function rules($id = '')
    {
        return [
            'name' => "required|min:3|max:100|unique:forums,name,{$id},id",
        ];
    }
}
