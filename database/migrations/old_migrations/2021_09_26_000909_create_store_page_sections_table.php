<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_page_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id');
            $table->integer('theme_id')->nullable();
            $table->string('handle')->nullable();
            $table->string('section');
            $table->longText('content')->nullable();
            $table->longText('json_content')->nullable();
            $table->integer('theme_file_id');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_page_sections');
    }
}
