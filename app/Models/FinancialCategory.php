<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialCategory extends Model
{
    protected $fillable = ['name', 'type'];

    public function rules($id = '')
    {
        return [
          'name' => 'required|min:3|max:100',
          'type' => 'required|in:Despesa,Receita'
        ];
    }
}
