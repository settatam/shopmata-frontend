<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Activity;
use App\Http\Helpers\Helper;


class LoadActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:actions';

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
        $data   =  Helper::getApiData('https://buymygold.com/api/sms?q=actions');
        if ($data){
            $bar = $this->output->createProgressBar(count($data['data']));
            foreach ($data['data'] as $action ) {
                $activity = new Activity;
                $activity = Activity::firstOrNew(
                    ['id' => $action['id'] ]
                );
                $activity->id                 =  $action['id'];
                $activity->name               =  $action['name'];
                $activity->activityable_type  =  'App\Models\Transaction';
                $activity->activityable_id    =  $action['order_id'];
                $activity->agent              =  $action['agent'];
                $activity->offer              =  $action['offer'];
                $activity->notes              =  $action['notes'];
                $activity->created_at         =  $action['created_at'];
                $activity->is_from_admin      =  true;
                $activity->save();
                $bar->advance();
            }

            $bar->finish();
        }

    }


}
