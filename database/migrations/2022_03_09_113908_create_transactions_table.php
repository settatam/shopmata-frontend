<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transactions')->nullable();
            $table->decimal('preliminary_offer', 8, 2)->nullable();
            $table->decimal('final_offer', 8, 2)->nullable();
            $table->decimal('estimated_value', 8, 2)->nullable();
            $table->integer('status_id')->nullable();
            $table->decimal('insurance_value', 8, 2)->nullable();
            $table->string('dwt')->nullable();
            $table->string('bin_location')->nullable();
            $table->text('customer_description')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
