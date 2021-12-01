<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('store_locations', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('address')->nullable();
        //     $table->string('address2')->nullable();
        //     $table->string('city')->nullable();
        //     $table->string('state_id')->nullable();
        //     $table->string('country_id')->nullable();
        //     $table->string('zip')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_locations');
    }
}
