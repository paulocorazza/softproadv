<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['state_id',  'title', 'iso', 'iso_ddd', 'status', 'slug', 'population', 'lat', 'long', 'income_per_capita'];

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
            'title'         => "required|min:3|max:100",
        ];
    }
}
