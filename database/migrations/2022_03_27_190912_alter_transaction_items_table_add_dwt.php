<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransactionItemsTableAddDwt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->decimal('price',8, 2);
            $table->string('dwt')->nullable();
            $table->string('category')->nullable();
            $table->longText('description')->nullable();
            $table->longTExt('inotes')->nullable();
            $table->boolean('override')->default(false);
            $table->integer('quantity')->nullable();
            $table->decimal('override_price',8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->dropColumn('category','price','dwt','description','inotes','override','quantity','override_price');
        });
    }
}
