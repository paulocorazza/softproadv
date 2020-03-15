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

    /**
     * @param string $id
     * @return array
     */
    public function rules($id = '')
    {
        return [
            'name'  => "required|min:3|max:60|unique:permissions,name,{$id},id",
            'label' => 'required|min:3|max:200',
        ];
    }

}
