<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorProcess extends Model
{
    use HasFactory;

    protected $fillable = ['number_process', 'tribunal', 'published_at', 'archived_at', 'process_id'];


    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeNotPublished($query)
    {
        return $query->whereNull('published_at');
    }

    public function scopeNotArchived($query)
    {
        return $query->whereNull('archived_at');
    }

}
