<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialAccountInstruction extends Model
{
    use HasFactory;

    protected $fillable = ['financial_account_id', 'instruction'];

    public function financialAccount()
    {
        return $this->belongsTo(FinancialAccount::class);
    }
}
