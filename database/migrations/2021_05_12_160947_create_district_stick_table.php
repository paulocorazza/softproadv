<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictStickTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_stick', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stick_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('district_stick');
    }
}
