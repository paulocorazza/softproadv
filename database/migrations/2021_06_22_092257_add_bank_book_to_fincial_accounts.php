<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankBookToFincialAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financial_accounts', function (Blueprint $table) {
            $table->string('bank_code', 3)->nullable();
            $table->string('bank_contract', 12);
            $table->string('cnpj')->nullable();

            $table->string('agency')->nullable();
            $table->string('agency_dv')->nullable();

            $table->string('account')->nullable();
            $table->string('account_dv')->nullable();
            $table->string('assignor')->nullable();
            $table->string('assignor_dv')->nullable();

            $table->decimal('fine',12,2)->default(0);
            $table->decimal('rate',12,2)->default(0);
            $table->integer('days_of_rate')->nullable();
            $table->integer('days_to_protest')->nullable();

            $table->string('code_protest')->nullable();
            $table->enum('cnab_shipping', ['400', '240'])->default('400');
            $table->enum('cnab_return', ['400', '240'])->default('400');
            $table->string('agreement')->nullable();
            $table->string('agreement_variation')->nullable();
            $table->string('accept')->nullable();
            $table->string('client_code')->nullable();
            $table->string('type_account')->nullable();
            $table->string('recipient')->nullable();
            $table->string('cep')->nullable();
            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('uf')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financial_accounts', function (Blueprint $table) {
            //
        });
    }
}
