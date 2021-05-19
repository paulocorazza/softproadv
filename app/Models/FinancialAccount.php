<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialAccount extends Model
{
    use HasFactory;

    protected $fillable = ['description'];

    public function rules($id = '')
    {
        return [
            'description' => 'required|min:3|max:100',
        ];
    }
}
