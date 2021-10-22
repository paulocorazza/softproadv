<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('person');
            $table->text('description')->nullable();
            $table->dateTime('concluded_at')->nullable();
            $table->timestamps();
        });

        Schema::create('meet_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('meet_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meet_users');
        Schema::dropIfExists('meets');
    }
}
