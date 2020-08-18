<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhaseTypeActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phase_type_action', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('type_action_id')->unsigned();
            $table->bigInteger('phase_id')->unsigned();
            $table->timestamps();


            $table->foreign('type_action_id')
                ->references('id')
                ->on('type_actions')
                ->onDelete('cascade');

            $table->foreign('phase_id')
                ->references('id')
                ->on('phases')
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
        Schema::dropIfExists('phase_type_action');
    }
}
