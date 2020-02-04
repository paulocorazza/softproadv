<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('type', ['A', 'U'])->default('A')->comment('A -> Advogado, U -> Usuário');

            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('ctps')->nullable();
            $table->string('oab')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('telephone')->nullable();
            $table->decimal('salary', 18, 2);
            $table->date('date_admission')->nullable();
            $table->date('date_resignation')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
