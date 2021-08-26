<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Notifications\ResetPasswordNotify;
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
        'uuid',
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
        'status',
        'nivel',
    ];

    protected $appends = ['url_image'];

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
            'fantasy'   => 'nullable|min:3|max:100',
            'email'     => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'image'     => 'image',
            'cpf'       => 'nullable|cpf|required_if:type,U',
            'password'  => 'required|min:3|max:20|confirmed',
            'type'      => 'required|in:A,U',
            'marital_status' => 'required|in:Solteiro,Casado,Separado,Divorciado,Viúvo',
            'oab'       => 'required_if:type,A',
        ];
    }

    public function rulesUpdate($id = '')
    {
        return [
            'name'      => 'required|min:3|max:100',
            'fantasy'   => 'nullable|min:3|max:100',
            'email'     => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'image'     => 'image',
            'cpf'       => 'nullable|cpf|required_if:type,U',
            'type'      => 'required|in:A,U',
            'marital_status' => 'required|in:Solteiro,Casado,Separado,Divorciado,Viúvo',
            'oab'       => 'required_if:type,A',
        ];
    }


    public function rulesProfile($id = '')
    {
        return [
            'name'      => 'required|min:3|max:100',
            'fantasy'   => 'nullable|min:3|max:100',
            'email'     => "required|min:3|max:100|email|unique:users,email,{$id},id",
            'image'     => 'image',
            'cpf'       => 'nullable|cpf|required_if:type,U',
            'type'      => 'required|in:A,U',
            'oab'       => 'required_if:type,A',
        ];
    }

    //Este método deveria traduzir o campo Type
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

    public function messages()
    {
        return $this->hasMany(Message::class);
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


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressble');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function people()
    {
        return $this->hasMany(Person::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function processesOwner()
    {
        return $this->hasMany(Process::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function processes()
    {
        return $this->belongsToMany(Process::class, 'process_user')
            ->withTimestamps();
    }

    public function eventsOwner()
    {
        return $this->belongsTo(Event::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_users');
    }


    public function userViews()
    {
        return $this->hasMany(UserView::class, 'user_id', 'id');
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

    public function getUrlImageAttribute()
    {
        if ($this->image)
         return 'storage/tenants/' . $this->image;
    }

    public function setSalaryAttribute($value)
    {
      $this->attributes['salary'] = Helper::replaceDecimal($value);
    }

    public function getSalaryAttribute($value)
    {
        return Helper::formatDecimal($value);
    }


    public function scopeAdvogados($query)
    {
        return $query->where('type', 'A');
    }

    public function scopeAtivos($query)
    {
        return $query->where('status', 'A');
    }

    public function scopeNivel1($query)
    {
        return $query->where('nivel', '1');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotify($token));
    }



}
