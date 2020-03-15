<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
   protected $fillable = ['id', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   public function states()
   {
       return $this->hasMany(State::class);
   }

    public function rules($id = '')
    {
        return [
            'id'     => "required|unique:countries,id,{$id},id",
            'name'   => "required|min:3|max:100|unique:countries,name,{$id},id",
        ];
    }

}
