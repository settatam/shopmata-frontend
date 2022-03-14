<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->string('image_url', 189)->nullable();
            $table->string('image_thumb', 189)->nullable();
            $table->string('image_alt', 189)->nullable();
            $table->integer('theme_id')->nullable();
            $table->longText('conditions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->dropColumn('image_url');
            $table->dropColumn('image_thumb');
            $table->dropColumn('image_alt');
            $table->dropColumn('theme_id');
            $table->dropColumn('conditions');
        });
    }
}
