<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'label'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'profile_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_profile');
    }


    /**
     * @param string $id
     * @return array
     */
    public function rules($id = '')
    {
        return [
            'name'  => "required|min:3|max:60|unique:profiles,name,{$id},id",
            'label' => 'required|min:3|max:200',
        ];
    }
}
