<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankAccountFieldsInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('account_holder')->nullable()->after('instock_wallet');
            $table->string('account_number')->nullable()->after('instock_wallet');
            $table->string('payment_method')->nullable()->after('instock_wallet');
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
            $table->dropColumn('account_holder');
            $table->dropColumn('account_number');
            $table->dropColumn('payment_method');
        });
    }
}
