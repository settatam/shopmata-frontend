<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTrafficTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_traffic', function (Blueprint $table) {
            $table->id();
            $table->string('source')->nullable();
            $table->string('campaign_id')->nullable();
            $table->string('adgroup_id')->nullable();
            $table->string('creative_id')->nullable();
            $table->string('keyword')->nullable();
            $table->string('matchtype')->nullable();
            $table->string('adposition')->nullable();
            $table->string('device')->nullable();
            $table->string('device_model')->nullable();
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
        Schema::dropIfExists('seo_traffic');
    }
}
