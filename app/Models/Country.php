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

}
