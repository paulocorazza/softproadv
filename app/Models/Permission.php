<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'label'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'permission_profile');
    }
}
