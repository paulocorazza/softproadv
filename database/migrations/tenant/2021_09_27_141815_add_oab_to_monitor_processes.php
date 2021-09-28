<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOabToMonitorProcesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monitor_processes', function (Blueprint $table) {
            $table->string('oab');
            $table->string('uf', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitor_processes', function (Blueprint $table) {
            $table->dropColumn('oab');
            $table->dropColumn('uf');
        });
    }
}
