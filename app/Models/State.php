<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['id', 'country_id', 'title', 'letter', 'iso', 'slug', 'icms', 'population'];

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

    public function usersStateMonitors()
    {
        return $this->belongsToMany(User::class, 'user_state_monitors');
    }

    public function rules($id = '')
    {
        return [
            'country_id' => 'required|exists:countries,id',
            'letter' => "required|max:2|unique:states,letter,{$id},id",
            'title' => "required|min:3|max:100|unique:states,title,{$id},id",
        ];
    }
}
