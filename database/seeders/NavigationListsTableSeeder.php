<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NavigationListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('navigation_lists')->delete();
        
        \DB::table('navigation_lists')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'name' => 'Test again',
                'navigation_id' => 1,
                'link' => 'test-again',
                'sort_order' => 0,
                'target' => NULL,
                'created_at' => '2021-09-25 06:54:16',
                'updated_at' => '2021-09-25 06:54:16',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'name' => 'Another Test',
                'navigation_id' => 1,
                'link' => 'another-test',
                'sort_order' => 0,
                'target' => NULL,
                'created_at' => '2021-09-25 06:54:38',
                'updated_at' => '2021-09-25 06:54:38',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 0,
                'name' => 'DSfasfa',
                'navigation_id' => 5,
                'link' => NULL,
                'sort_order' => 0,
                'target' => NULL,
                'created_at' => '2021-09-30 00:19:36',
                'updated_at' => '2021-09-30 00:19:36',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 0,
                'name' => 'Another Item',
                'navigation_id' => 5,
                'link' => NULL,
                'sort_order' => 0,
                'target' => NULL,
                'created_at' => '2021-09-30 00:19:47',
                'updated_at' => '2021-09-30 00:19:47',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 0,
                'name' => 'as;fjasklfdjla',
                'navigation_id' => 1,
                'link' => NULL,
                'sort_order' => 0,
                'target' => NULL,
                'created_at' => '2021-10-10 04:11:32',
                'updated_at' => '2021-10-10 04:11:32',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}