<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventsConditionsTableAddStoreNotificationId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_conditions', function (Blueprint $table) {
            $table->dropColumn('store_notication_id');
            $table->integer('store_notification_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_conditions', function (Blueprint $table) {
        });
    }
}
