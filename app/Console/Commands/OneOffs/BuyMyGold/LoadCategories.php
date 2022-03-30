<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Category;
use App\Http\Helpers\Helper;


class LoadCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $stores;

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
        $data   =  Helper::getApiData('https://buymygold.com/api/sms?q=categories');
        if ($data){
            $bar = $this->output->createProgressBar(count($data['data']));
            foreach ($data['data'] as $cat ) {
                $category = new Category;
                $category = Category::firstOrNew(
                    ['id' => $cat['id']]
                );
                $category->id          =  $cat['id'];
                $category->name        =  $cat['name'];
                $category->dwt_formula =  $cat['dwt_formula'];
                $category->sort_order  =  $cat['sort_order'];
                $category->long_name   =  $cat['long_name'];
                $category->store_id   =  2;

                $category->save();                      
                $bar->advance();
            }

            $bar->finish();
        }

    }


}
