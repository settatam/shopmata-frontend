<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Store;
use App\Models\Sms;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;





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
            foreach ($data['data'] as $sm ) {
                $sms = new Sms;
                $sms = Sms::firstOrNew(
                    ['id' => $sm['id']]
                );
                $sms->id           = $sm['id'];                       
                $sms->message      = $sm['message'];                        
                $sms->from         = $sm['from'];                        
                $sms->to           = $sm['to'];                       
                $sms->is_read      = $sm['is_read'];                    
                $sms->created_at   = date("H:i:s", strtotime($sm['created_at']));                       
                $sms->user_id      = $sm['user_id'];                        
                $sms->smsable_id   = $sm['order_id']; 
                $sms->smsable_type = 'App\Models\Transaction';                        
                $sms->is_coming    = $sm['is_coming'];                       
                $sms->store_id     = Helper::getStoreByName('BuyMyGold');
                $sms->user_id      = $sm['user_id'];   
                $sms->tem_url      = $sm['images'];                      
                $sms->save();  
                $bar->advance();
            }

            $bar->finish();
        }
    }



}
