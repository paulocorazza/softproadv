<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorProcess extends Model
{
    use HasFactory;

    protected $fillable = ['number_process', 'tribunal', 'published_at', 'archived_at', 'process_id', 'oab', 'uf'];

    protected $appends = ['created_at_br'];


    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function getCreatedAtBrAttribute()
    {
        return Helper::formatDateTime($this->attributes['created_at'], 'd/m/Y');
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
