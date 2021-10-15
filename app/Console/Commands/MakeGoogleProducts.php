<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProductType;

class MakeGoogleProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:types';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create google types from text file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = public_path().'/assets/product-types.txt';
        $handle = fopen($file, "r") or die("Unable to open file!");
        if($handle) {
            while(($line = fgets($handle)) !== false){
                $google_ids = explode('-', $line, 2);
                $google_field_id = trim($google_ids[0]);
                $pas = explode('>', $google_ids[1]);
                $parent_id = 0;
                // foreach($paths as $index => $path) {
                $data['google_field_id'] = $google_field_id;
                $data['name'] = trim(end($pas));
                $data['full_path'] = trim($google_ids[1]);
                $data['level'] = count($pas);
                $par = count($pas) > 1 ? count($pas)-2:0;

                if(count($pas) > 1) {
                    $parent_name = trim($pas[$par]);
                    ProductType::where('name', $parent_name)->update(['is_final'=>0]);
                    $p = ProductType::where('name', $parent_name)->orderBy('id', 'desc')->first();
                    if(null!== $p){
                        $data['parent_id'] = $p->id;
                        $data['is_final'] = 1;
                    }
                }else{
                    $data['parent_id'] = 1;
                }
                echo 'creating data for ' . $data['full_path'] . PHP_EOL;
                if(ProductType::create($data)) {
                    echo 'created data for ' . $data['full_path'] . PHP_EOL;
                }else{
                    echo 'could not create for ' . $data['full_path'] . PHP_EOL;
                }
                
                // }
            }
        }
        fclose($handle);
        dd('this is working');
        return 0;
    }
}
