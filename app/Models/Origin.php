<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    protected $fillable = ['name'];

    public function rules($id = '')
    {
        return [
            'name' => "required|min:3|max:100|unique:origins,name,{$id},id",
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
