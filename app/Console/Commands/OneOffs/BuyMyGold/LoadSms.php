<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Store;
use App\Models\Sms;
use App\Http\Helpers\Helper;


class LoadSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:sms';

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
        $data   =  Helper::getApiData('https://buymygold.com/api/sms');

        if ($data){
            $bar = $this->output->createProgressBar(count($data['data']));

            foreach ($data['data'] as $smses ) {

                $sms = new Sms;
                $sms = Sms::firstOrNew(
                    ['id' => $smses['id']]
                );
                $sms->id             =  $smses['id'];                        
                $sms->message        =  $smses['message'];                        
                $sms->from           =  $smses['from'];                        
                $sms->to             =  $smses['to'];                         
                $sms->is_read        =  $smses['is_read'];                        
                $sms->created_at     =  date("H:i:s", strtotime($smses['created_at']));                        
                $sms->user_id        =  $smses['user_id'];                        
                $sms->smsable_id     =  $smses['order_id']; 
                $sms->smsable_type   =  'App\Models\Transaction';                        
                $sms->is_coming      =  $smses['is_coming'];                        
                $sms->payload        =  $smses['payload'];   
                $sms->save();                      
                $bar->advance();
            }

            $bar->finish();
        }
    }

    

}
