<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStoreActualNotificationsTableChangeNotificationsToMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_actual_notifications', function (Blueprint $table) {
            $table->renameColumn('notifications','message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_actual_notifications', function (Blueprint $table) {
            //
        });
    }
}
