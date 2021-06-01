<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public const TYPE_PERSON = [
        'Contato' => 'Contato',
        'Cliente' => 'Cliente',
        'Fornecedor' => 'Fornecedor',
        'Parte Contrária' => 'Parte Contrária'
    ];


    protected $fillable = [
        'name',
        'type_person',
        'fantasy',
        'site',
        'email',
        'image',
        'cpf',
        'cnpj',
        'rg',
        'date_birth',
        'cellphone',
        'telephone',
        'type',
        'partner',
        'marital_status',
        'father',
        'mother',
        'naturalness',
        'nationality',
        'office',
        'observation',
        'status',
        'user_id',
        'origin_id',
    ];

    public function rules($id = '')
    {
        return [
            'type_person' => 'required',
            'name'      => 'required|min:3|max:100',
            'fantasy'   => 'required|min:3|max:100',
            'email'     => "nullable|min:3|max:100|email",
            'image'     => 'image',
            'type'      => 'required|in:F,J',
            'cpf'       => 'nullable|cpf|required_if:type,F',
            'cnpj'      => 'nullable|cnpj|required_if:type,J',
            'marital_status' => 'required|in:Solteiro,Casado,Separado,Divorciado,Viúvo',
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressble');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function processes()
    {
        return $this->hasMany(Process::class);
    }

    public function financials()
    {
        return $this->hasMany(Financial::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', '=', 'A');
    }
}
