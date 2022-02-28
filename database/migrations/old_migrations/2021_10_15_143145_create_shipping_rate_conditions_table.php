<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingRateConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_rate_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('condition');    
            $table->text('description')->nullable(); //not more than 120 characters
            $table->decimal('price',10,2)->default(0);
            $table->integer('user_id');
            $table->integer('shipping_rate_id');
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
        Schema::dropIfExists('shipping_rate_conditions');
    }
}
