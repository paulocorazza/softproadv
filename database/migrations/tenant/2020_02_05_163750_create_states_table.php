<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->string('title')->unique();
            $table->string('letter')->unique();
            $table->integer('iso')->unique();
            $table->string('slug')->unique();
            $table->decimal('icms', 12, 2)->nullable();
            $table->integer('population')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
