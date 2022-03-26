<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPaymentAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payment_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id');
            $table->integer('payment_type_id');
            $table->string('paypal_address')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('bank_address_2')->nullable();
            $table->string('bank_address_city')->nullable();
            $table->string('bank_address_state_id')->nullable();
            $table->string('bank_address_zip')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_type')->nullable();
            $table->string('venmo_address')->nullable();
            $table->string('check_name')->nullable();
            $table->string('check_address')->nullable();
            $table->string('check_address_2')->nullable();
            $table->string('check_city')->nullable();
            $table->integer('check_state_id')->nullable();
            $table->string('check_country')->nullable();
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
        Schema::dropIfExists('transaction_payment_addresses');
    }
}
