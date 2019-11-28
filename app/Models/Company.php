<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Company extends Model
{
    protected $fillable = [
          'name',
          'subdomain',
          'db_database',
          'db_host',
          'db_username',
          'db_password'
        ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::creating(function($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }
}
