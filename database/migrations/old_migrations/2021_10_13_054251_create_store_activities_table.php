<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('activity');
            $table->string('model')->nullable();
            $table->integer('activity_id')->nullable();
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
        Schema::dropIfExists('store_activities');
    }
}
