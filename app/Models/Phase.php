<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $fillable = ['name'];

    public function rules($id = '')
    {
        return [
            'name' => "required|min:3|max:100|unique:phases,name,{$id},id",
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function typeAction()
    {
        return $this->belongsToMany(TypeAction::class, 'phase_type_action');
    }
}
