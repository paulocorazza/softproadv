<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'fantasy',
        'site',
        'email',
        'password',
        'image',
        'cpf',
        'cnpj',
        'rg',
        'date_birth',
        'ctps',
        'oab',
        'cellphone',
        'telephone',
        'salary',
        'date_admission',
        'date_resignation',
        'type',
        'partner',
        'marital_status',
        'father',
        'mother',
        'naturalness',
        'nationality',
        'office',
        'journey_start',
        'journey_pause',
        'journey_end',
        'observation',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'salary' => 'double',
        'email_verified_at' => 'datetime',
    ];


    public function rules($id = '')
    {
        return [
            'name'      => 'required|min:3|max:100',
            'fantasy'   => 'required|min:3|max:100',
            'email'     => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'image'     => 'image',
            'cpf'       => 'cpf',
            'password'  => 'required|min:3|max:20|confirmed',
            'type'      => 'required|in:A,U',
            'oab'       => 'required_if:type,A',
        ];
    }

    public function rulesUpdate($id = '')
    {
        return [
            'name'      => 'required|min:3|max:100',
            'fantasy'   => 'required|min:3|max:100',
            'email'     => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'image'     => 'image',
            'cpf'       => 'cpf',
            'type'      => 'required|in:A,U',
            'oab'       => 'required_if:type,A',
        ];
    }

    public function attributes()
    {
        return [
          'type' => 'Tipo de Usuário'
        ];
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accesses()
    {
        return $this->hasMany(Access::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function registerAccess()
    {
        return $this->accesses()->create([
            'user_id' => $this->id,
            'datetime' => date('YmdHis'),
        ]);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_user');
    }


    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressble');
    }


    /**
     * @param Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasProfile($permission->profiles()->get());
    }


    /**
     * @param $profile
     * @return bool
     */
    public function hasProfile($profile)
    {
        if (is_string($profile)) {
            return $this->profiles()->get()->contains('name', $profile);
        }

        return !!$profile->intersect($this->profiles()->get())->count();
    }


    public function setSalaryAttribute($value)
    {
      $this->attributes['salary'] = Helper::replaceDecimal($value);
    }

    public function getSalaryAttribute($value)
    {
        return Helper::formatDecimal($value);
    }
}
