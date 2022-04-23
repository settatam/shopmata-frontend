<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->longText('content')->nullable();
            $table->string('name');
            $table->integer('template_id');
            $table->integer('theme_id');
            $table->integer('store_id');
            $table->longText('header_content')->nullable();
            $table->longText('footer_content')->nullable();
            $table->text('title')->nullable();
            $table->text('seo_content')->nullable();
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
        Schema::dropIfExists('store_pages');
    }
}
