<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_installments', function (Blueprint $table) {
            $table->id();
            $table->float('price')->default(0);
            $table->float('monthly_amount')->default(0);
            $table->string('duration')->default(12);
            $table->unsignedSmallInteger('product_id')->nullable();
            $table->unsignedSmallInteger('user_id')->nullable();
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
        Schema::dropIfExists('product_installments');
    }
}
