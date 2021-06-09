<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJudgeToProcesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('processes', function (Blueprint $table) {
            $table->unsignedBigInteger('judge_id')->nullable();

            $table->foreign('judge_id')
                    ->references('id')
                    ->on('people')
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
        Schema::table('processes', function (Blueprint $table) {
            $table->dropColumn('judge_id');
        });
    }
}
