<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableShippingLabelsAddIsReturn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_labels', function (Blueprint $table) {
            if (!Schema::hasColumn('shipping_labels', 'is_return'))
            {
                $table->integer('is_return')->nullable();
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
        Schema::table('shipping_labels', function (Blueprint $table) {
            $table->dropColumn('is_return');
        });
    }
}
