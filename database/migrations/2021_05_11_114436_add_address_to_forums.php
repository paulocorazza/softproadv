<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToForums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forums', function (Blueprint $table) {
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('district')->nullable();
            $table->string('complement')->nullable();
            $table->string('cep')->nullable();
            $table->string('uf')->nullable();
            $table->string('city')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('site')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forums', function (Blueprint $table) {
            $table->dropColumn('street');
            $table->dropColumn('number');
            $table->dropColumn('district');
            $table->dropColumn('complement');
            $table->dropColumn('cep');
            $table->dropColumn('uf');
            $table->dropColumn('city');
            $table->dropColumn('telephone');
            $table->dropColumn('email');
            $table->dropColumn('site');
        });
    }
}
