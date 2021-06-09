<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessStage extends Model
{
    use HasFactory;

    protected $fillable = ['process_id, stage_id, user_id'];

    protected $table = 'process_stage';

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
