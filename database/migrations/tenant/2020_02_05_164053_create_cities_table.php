<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigInteger('id')->unique()->unsigned();
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->integer('iso');
            $table->integer('iso_ddd')->nullable();
            $table->integer('status')->nullable();
            $table->string('slug')->nullable();
            $table->integer('population')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->decimal('income_per_capita', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
