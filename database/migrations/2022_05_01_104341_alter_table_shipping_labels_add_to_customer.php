<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableShippingLabelsAddToCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_labels', function (Blueprint $table) {

            if (!Schema::hasColumn('shipping_labels', 'to_customer'))
            {
                $table->string('to_customer')->nullable();
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
            $table->dropColumn('to_customer');
        });
    }
}
