<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_progresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->date('date_term');
            $table->string('description');
            $table->text('publication');
            $table->boolean('concluded');

            $table->bigInteger('process_id')->unsigned();
            $table->timestamps();


            $table->foreign('process_id')
                ->references('id')
                ->on('processes')
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
        Schema::dropIfExists('process_progresses');
    }
}
