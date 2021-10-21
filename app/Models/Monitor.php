<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;

    protected $fillable = ['origin', 'oab', 'uf', 'process_id'];

    public function processes()
    {
        return $this->belongsTo(Process::class);
    }

    public function scopeOAB($query)
    {
        return $query->where('origin', 'OAB');
    }

    public function scopeProcess($query)
    {
        return $query->where('origin', 'Process');
    }
}
