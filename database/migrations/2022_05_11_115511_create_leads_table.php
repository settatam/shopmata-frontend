<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Lead;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('store_id')->nullable();
            $table->timestamps();
        });

        $leads = [    
                    'Referral',
                    'TV',
                    'NY Post',
                    'Facebook',
                    'IG',
                    'Unknown',
                    'Google- CPC',
                    'Bing- CPC',
                    'Facebook',
                    'CIMB',
                    'National',
                ];

        foreach($leads as $lead){
           $l = new Lead;
           $l->name = $lead;
           $l->save(); 
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
