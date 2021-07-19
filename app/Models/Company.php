<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Company extends Model
{
    protected $fillable = [
        'name',
        'cellphone',
        'cpf',
        'oab',
        'uf_oab',
        'qtd_processes',
        'email',
        'payment_status',
        'subdomain',
        'db_database',
        'db_host',
        'db_username',
        'db_password'
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (empty($model->db_database))
                $model->db_database = $model->subdomain . '-adv';

            if (empty($model->db_host)) {
                 $model->db_host = config('database.connections.tenant.host');
            }

            if (empty($model->db_username))
                $model->db_username = config('database.connections.tenant.username');

            if (empty($model->db_password))
                $model->db_password = config('database.connections.tenant.password');

            $model->uuid = (string)Uuid::uuid4();
        });
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
