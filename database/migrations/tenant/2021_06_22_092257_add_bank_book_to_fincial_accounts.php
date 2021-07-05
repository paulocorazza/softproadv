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
            $table->string('bank_contract', 12)->nullable();
            $table->string('cnpj')->nullable();

            $table->string('agency')->nullable();
            $table->string('agency_dv')->nullable();

            $table->string('account')->nullable();
            $table->string('account_dv')->nullable();
            $table->string('assignor')->nullable();
            $table->string('assignor_dv')->nullable();

            $table->decimal('fine',12,2)->default(0)->nullable();
            $table->decimal('rate',12,2)->default(0)->nullable();
            $table->integer('days_of_rate')->nullable();
            $table->integer('days_to_protest')->nullable();

            $table->string('code_protest')->nullable();
            $table->enum('cnab_shipping', ['400', '240'])->default('400')->nullable();
            $table->enum('cnab_return', ['400', '240'])->default('400')->nullable();
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
            $table->dropColumn('bank_code');
            $table->dropColumn('bank_contract');
            $table->dropColumn('cnpj');

            $table->dropColumn('agency');
            $table->dropColumn('agency_dv');

            $table->dropColumn('account');
            $table->dropColumn('account_dv');
            $table->dropColumn('assignor');
            $table->dropColumn('assignor_dv');

            $table->dropColumn('fine');
            $table->dropColumn('rate');
            $table->dropColumn('days_of_rate');
            $table->dropColumn('days_to_protest');

            $table->dropColumn('code_protest');
            $table->dropColumn('cnab_shipping');
            $table->dropColumn('cnab_return');
            $table->dropColumn('agreement');
            $table->dropColumn('agreement_variation');
            $table->dropColumn('accept');
            $table->dropColumn('client_code');
            $table->dropColumn('type_account');
            $table->dropColumn('recipient');
            $table->dropColumn('cep');
            $table->dropColumn('address');
            $table->dropColumn('district');
            $table->dropColumn('city');
            $table->dropColumn('uf');
        });
    }
}
