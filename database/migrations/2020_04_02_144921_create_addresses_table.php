<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('type_address_id')->unsigned();
            $table->string('street');
            $table->string('number');
            $table->string('district');
            $table->string('complement')->nullable();
            $table->string('cep');
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('state_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();


            $table->morphs('addressble');
            $table->timestamps();

            $table->foreign('type_address_id')
                ->references('id')
                ->on('type_addresses')
                ->onDelete('cascade');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');

            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->onDelete('cascade');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
