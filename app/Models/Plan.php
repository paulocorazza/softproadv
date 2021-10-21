<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $appends = ['price_br'];

    protected $fillable = [
        'description',
        'price',
        'frequency',
        'frequency_interval',
        'cycles',
        'key_paypal',
        'key_pagseguro',
        'state_paypal',
        'state_pagseguro',
        'oab_count_search',
        'processes_count_search'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plan_details()
    {
        return $this->hasMany(PlanDetail::class);
    }

    public function getPriceBrAttribute()
    {
        return Helper::formatDecimal($this->attributes['price']);
    }
}
