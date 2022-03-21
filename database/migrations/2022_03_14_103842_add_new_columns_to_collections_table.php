<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collections', function (Blueprint $table) {
            
            //$table->string('image_url', 189)->nullable();
            //$table->string('image_thumb', 189)->nullable();
           // $table->string('image_alt', 189)->nullable();
            //$table->integer('theme_id')->nullable();
            //$table->longText('conditions');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('seo_description','seo_title','conditions','image_url','image_thumb','image_alt','theme_id');
    }


    // public function myDropColumnIfExists($table, $col)
    // {
    //     if (!Schema::hasColumn('collections', 'image_url')) //check the column
    //     {
    //         $table->string($col)->nullable();
    //     }

    // }

}
