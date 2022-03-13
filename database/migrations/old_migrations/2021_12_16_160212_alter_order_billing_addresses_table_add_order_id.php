<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrderBillingAddressesTableAddOrderId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_billing_addresses', function (Blueprint $table) {
            $table->string('paypal_address',50)->nullable();
            $table->string('venmo_address',50)->nullable();
            // $table->integer('order_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_billing_addresses', function (Blueprint $table) {
            //
        });
    }
}
