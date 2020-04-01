<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['state_id',  'name', 'siafi'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function rules($id = '')
    {
        return [
            'state_id'      => 'required|exists:states,id',
            'name'          => "required|min:3|max:100|unique:cities,name,{$id},id",
        ];
    }
}
