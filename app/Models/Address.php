<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'type_address_id',
        'street',
        'number',
        'district',
        'complement',
        'cep',
        'country_id',
        'state_id',
        'city_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressble()
    {
        return $this->morphTo();
    }
}
