<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['country_id', 'initials', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function rules($id = '')
    {
        return [
            'country_id'    => 'required|exists:countries,id',
            'initials'      => "required|max:2|unique:states,initials,{$id},id",
            'name'          => "required|min:3|max:100|unique:states,name,{$id},id",
        ];
    }
}
