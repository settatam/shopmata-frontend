<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('store_groups')->delete();
        
        \DB::table('store_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Owner',
                'created_at' => '2020-10-31 05:00:01',
                'updated_at' => '2020-10-31 05:00:01',
                'description' => 'Has full access to manage, edit & publish site, including billing, domains and inviting people, but cannot delete or transfer site.',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Developer',
                'created_at' => '2020-10-31 05:00:01',
                'updated_at' => '2020-10-31 05:00:01',
                'description' => 'Has access to manage, edit & publish site, but cannot manage billing, delete, duplicate or transfer site.',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Guest',
                'created_at' => '2020-10-31 05:00:01',
                'updated_at' => '2020-10-31 05:00:01',
                'description' => 'Can view store but no permission to eidit',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Admin',
                'created_at' => '2020-10-31 05:00:01',
                'updated_at' => '2020-10-31 05:00:01',
                'description' => 'Has full access to manage, edit & publish site, including billing, domains and inviting people, but cannot delete or transfer site.',
            ),
        ));
        
        
    }
}