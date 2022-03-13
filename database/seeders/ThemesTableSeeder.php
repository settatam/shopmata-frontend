<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('themes')->delete();
        
        \DB::table('themes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Default',
                'developer_id' => 1,
                'is_active' => 1,
                'slug' => 'default',
                'size' => '20',
                'last_update' => '2021-10-01 05:00:01',
                'is_documented' => 1,
                'is_responsive' => 1,
                'approval_date' => '2021-10-01 05:00:01',
                'approved_by' => 1,
                'framework_compatibilty' => 'All',
                'updated_at' => '2021-10-01 05:00:01',
                'created_at' => '2021-10-01 05:00:01',
            ),
        ));
        
        
    }
}