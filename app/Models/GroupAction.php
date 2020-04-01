<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupAction extends Model
{
    protected $fillable = ['name'];

    /**
     * @param string $id
     * @return array
     */
    public function rules($id = '')
    {
        return [
            'name' => "required|min:3|max:100|unique:group_actions,name,{$id},id",
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function type_actions()
    {
        return $this->hasMany(TypeAction::class);
    }
}
