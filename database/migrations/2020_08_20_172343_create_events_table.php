<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('process_id')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('color', 7);
            $table->text('description')->nullable();
            $table->boolean('schedule');
            $table->dateTime('finish')->nullable();
            $table->string('file')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('process_id')
                ->references('id')
                ->on('processes')
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
        Schema::dropIfExists('events');
    }
}
