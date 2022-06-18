<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventConditionsTableAddEventId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_conditions', function (Blueprint $table) {
            if (!Schema::hasColumn('event_conditions', 'event_id'))
            {
                $table->integer('event_id')->nullable();
            }
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
            $table->dropColumn('event_id');
        });
    }
}
