<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypePublishedArchivedToProcessProgresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process_progresses', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
            $table->dateTime('archived_at')->nullable();
            $table->enum('type', ['Andamento', 'Petição'])->default('Andamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process_progresses', function (Blueprint $table) {
            $table->dropColumn('published_at');
            $table->dropColumn('archived_at');
            $table->dropColumn('type');
        });
    }
}
