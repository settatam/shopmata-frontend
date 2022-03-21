<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNotificationMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_notification_messages', function (Blueprint $table) {
            //
            $table->integer('store_notification_id');
            //$table->integer('store_id');
            $table->enum('channel', ['email', 'sms', 'voice', 'slack']);
            $table->boolean('should_queue')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_notification_messages', function (Blueprint $table) {
            //
        });
    }
}
