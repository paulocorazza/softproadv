<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessStageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_stage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('process_id')->unsigned();
            $table->bigInteger('stage_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->timestamps();

            $table->foreign('process_id')
                ->references('id')
                ->on('processes')
                ->onDelete('cascade');

            $table->foreign('stage_id')
                ->references('id')
                ->on('stages')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('process_stage');
    }
}
