<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiGoogleCredentialsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_calendar_api_key')->nullable();
            $table->string('google_calendar_id')->nullable();
            $table->string('google_service_account_credentials')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google_calendar_api_key');
            $table->dropColumn('google_calendar_id');
            $table->dropColumn('google_service_account_credentials');

        });
    }
}
