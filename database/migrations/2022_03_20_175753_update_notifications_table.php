<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_notifications', function (Blueprint $table) {
            //
            $table->boolean('is_default')->default(false);
            $table->integer('store_id')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_notifications', function (Blueprint $table) {
            $table->dropColumn('is_default','store_id','user_id');
        });
    }
}
