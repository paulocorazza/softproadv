<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\TextUI\Help;

class Meet extends Model
{
    use HasFactory;

    protected $appends = ['created_at_br'];

    protected $fillable = ['process_id', 'user_id', 'title', 'person', 'description', 'concluded_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'meet_users');
    }

    public function rules()
    {
        return [
            'title'         => 'required|min:3',
            'person'        => 'required|min:3',
            'process_id'    => 'nullable|exists:processes,id'
        ];
    }

    public function getCreatedAtBrAttribute()
    {
        return Helper::formatDateTime($this->attributes['created_at']);
    }

    public function isConcluded() : bool
    {
        return !empty($this->concluded_at);
    }

    public function scopeConcluded($query)
    {
        return $query->whereNotNull('concluded_at');
    }
}
