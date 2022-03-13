<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'store_id' => 2,
                'user_id' => 66,
                'title' => 'This is my test',
                'content' => NULL,
                'status' => NULL,
                'slug' => 'this-is-my-test',
                'created_at' => '2020-02-01 01:00:01',
                'updated_at' => '2020-02-01 01:00:01',
                'is_blog' => 0,
                'featured_image' => NULL,
                'theme_template_id' => 2,
                'seo_title' => 'test',
                'seo_description' => 'test',
                'visibility_date' => NULL,
                'is_visible' => 1,
                'excerpt' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'store_id' => 2,
                'user_id' => 66,
                'title' => 'Test new page',
                'content' => '<p>This is a test of the new page for this</p>',
                'status' => NULL,
                'slug' => NULL,
                'created_at' => '2021-07-03 09:02:49',
                'updated_at' => '2021-07-03 09:02:49',
                'is_blog' => 0,
                'featured_image' => NULL,
                'theme_template_id' => 0,
                'seo_title' => 'The title of my SEO',
                'seo_description' => 'This is a description of the SEO that this pages should be having',
                'visibility_date' => NULL,
                'is_visible' => 0,
                'excerpt' => NULL,
            ),
        ));
        
        
    }
}