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
            $table->string('fantasy');
            $table->string('site');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->enum('type', ['A', 'U'])->default('A')->comment('A -> Advogado, U -> Usuário');

            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('rg')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('ctps')->nullable();
            $table->string('oab')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('telephone')->nullable();
            $table->string('partner')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('naturalness')->nullable();
            $table->string('nationality')->nullable();
            $table->string('office')->nullable();
            $table->time('journey_start')->nullable();
            $table->time('journey_pause')->nullable();
            $table->time('journey_end')->nullable();
            $table->decimal('salary', 18, 2);
            $table->date('date_admission')->nullable();
            $table->date('date_resignation')->nullable();
            $table->text('observation')->nullable();
            $table->enum('status', ['A', 'I'])->default('A')->comment('A -> Ativo, I -> Inativo');

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
