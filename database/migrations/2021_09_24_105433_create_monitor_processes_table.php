<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitor_processes', function (Blueprint $table) {
            $table->id();
            $table->string('number_process');
            $table->string('tribunal')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->dateTime('archived_at')->nullable();
            $table->foreignId('process_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitor_processes');
    }
}
