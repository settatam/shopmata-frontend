<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailSubjectToStoreNotificationMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_notification_messages', function (Blueprint $table) {
            $table->string('email_subject')->after('store_id')->nullable();
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
            $table->dropColumn('email_subject');
        });
    }
}
