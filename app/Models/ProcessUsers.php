<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessUsers extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'process_id'];
    protected $table = 'process_user';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
