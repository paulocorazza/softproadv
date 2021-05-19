<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stick extends Model
{
    protected $fillable = ['name'];

    public function rules($id = '')
    {
        return [
            'name' => "required|min:3|max:100|unique:sticks,name,{$id},id",
        ];
    }

    public function districts()
    {
        return $this->belongsToMany(District::class, 'district_stick');
    }
}
