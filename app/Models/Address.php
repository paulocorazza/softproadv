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

    public function type_address()
    {
       return $this->belongsTo(TypeAddress::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }


    public function rules($id = '')
    {
        return [
            'type_address_id'   => 'required|exists:type_addresses',
            'street'            => 'required|min:3|max:100',
            'number'            => 'required|max:100',
            'district'          => "required|min:3|max:100",
            'cep'               => 'required|cep',
            'country_id'        => 'required|exists:countries',
            'state_id'          => 'required|exists:states',
            'city_id'           => 'required|exists:cities',
        ];
    }
}
