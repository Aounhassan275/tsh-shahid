<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShoppingWalletToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->double('shopping_wallet')->default(0)->nullable()->after('role');
            $table->double('amount_for_shop')->default(0)->nullable()->after('role');
            $table->double('instock_wallet')->default(0)->nullable()->after('role');
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
            $table->dropColumn('shopping_wallet');
            $table->dropColumn('amount_for_shop');
            $table->dropColumn('instock_wallet');
        });
    }
}
