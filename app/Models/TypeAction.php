<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeAction extends Model
{
    protected $fillable = ['name', 'group_action_id'];

    /**
     * @param string $id
     * @return array
     */
    public function rules($id = '')
    {
        return [
            'name'            => "required|min:3|max:100|unique:type_actions,name,{$id},id",
            'group_action_id' => "required|exists:group_actions,id"
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group_action()
    {
        return $this->belongsTo(GroupAction::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function phases()
    {
        return $this->belongsToMany(Phase::class, 'phase_type_action');
    }

    public function processes()
    {
        return $this->hasMany(Process::class);
    }



}
