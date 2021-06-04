<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financials', function (Blueprint $table) {
            $table->index('due_date');
            $table->index('competence');
            $table->index('payday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financials', function (Blueprint $table) {
            $table->dropIndex('financials_due_date_index');
            $table->dropIndex('financials_competence_index');
            $table->dropIndex('financials_payday_index');
        });
    }
}
