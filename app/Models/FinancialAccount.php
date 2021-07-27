<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialAccount extends Model
{
    use HasFactory;

    public const BANKS = [
        '001' => 'Banco do Brasil',
        '273' => 'Bradesco',
        '104' => 'Caixa Federal',
        '399' => 'HSBC',
        '341' => 'Itaú',
        '033' => 'Santander',
        '748' => 'Sicredi',
        '999' => 'Outro',
    ];

    public const CNAB = [
      '240' => '240',
      '400' => '400'
    ];

    protected $fillable = [
        'description',
        'bank_code',
        'bank_contract',
        'cnpj',
        'agency',
        'agency_dv',
        'account',
        'account_dv',
        'assignor',
        'assignor_dv',
        'fine',
        'rate',
        'days_of_rate',
        'days_to_protest',
        'code_protest',
        'cnab_shipping',
        'cnab_return',
        'agreement',
        'agreement_variation',
        'accept',
        'client_code',
        'type_account',

        'recipient',
        'cep',
        'address',
        'district',
        'city',
        'uf'
    ];

    public function rules($id = '')
    {
        return [
            'description' => 'required|min:3|max:100',
        ];
    }

    public function instructions()
    {
        return $this->hasMany(FinancialAccountInstruction::class);
    }

    public function isItau()
    {
        return $this->bank_code == self::BANKS['341'];
    }
}
