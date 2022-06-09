<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use Illuminate\Console\Command;
use App\Models\Customer;
use App\Models\Tag;

use App\Http\Helpers\Helper;





class LoadCustomerTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:loadcustomertags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $tags   =  Customer::TAGS;
        if ($tags){
            $bar = $this->output->createProgressBar(count($tags));
            foreach ($tags as $tag ) {
                $t = Tag::firstOrNew(
                    ['name' => $tag]
                );
                $t->name = $tag;
                $t->save();
                $bar->advance();
            }

            $bar->finish();
        }
    }



}
