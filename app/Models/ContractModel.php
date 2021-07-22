<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractModel extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'contract'];

    public function rules($id = '')
    {
        return [
            'description'      => "required|min:3|max:60|unique:contract_models,description,{$id},id",
            'contract'         => "required",
        ];
    }
}
