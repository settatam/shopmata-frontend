<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('activityable_type');
            $table->integer('activityable_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->string('status')->nullable();
            $table->string('agent')->nullable();
            $table->decimal('offer',8,2)->nullable();
            $table->longText('notes')->nullable();
            $table->string('name')->nullable();
            $table->boolean('is_from_admin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
