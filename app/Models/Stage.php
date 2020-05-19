<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = ['name', 'phase_id'];

    public function rules($id = '')
    {
        return [
            'name'            => "required|min:3|max:100|unique:stages,name,{$id},id",
            'phase_id'        => "required|exists:phases,id"
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function processesOwner()
    {
        return $this->hasMany(Process::class);
    }


    public function processes()
    {
        return $this->belongsToMany(Process::class, 'process_stage')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }
}
