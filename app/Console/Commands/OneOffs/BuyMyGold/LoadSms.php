<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Store;
use App\Models\Sms;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use Image as Img;
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

    
        $smses = Sms::all();
        foreach ($smses as $sms) {
            $sms->delete();
        }

        $context = stream_context_create(
            array(
                'http' => array(
                    'follow_location' => false
                )
            )
        );
        

        if ($data){
            $bar = $this->output->createProgressBar(count($data['data']));
           // Storage::makeDirectory('sms');
            foreach ($data['data'] as $sm ) {
                $sms = new Sms;
                $sms->id           =  $sm['id'];                       
                $sms->message      =  $sm['message'];                        
                $sms->from         =  $sm['from'];                        
                $sms->to           =  $sm['to'];                       
                $sms->is_read      =  $sm['is_read'];                    
                $sms->created_at   =  date("H:i:s", strtotime($sm['created_at']));                       
                $sms->user_id      =  $sm['user_id'];                        
                $sms->smsable_id   =  $sm['order_id']; 
                $sms->smsable_type =  'App\Models\Transaction';                        
                $sms->is_coming    =  $sm['is_coming'];                       
                $sms->store_id     =  Helper::getStoreByName('BuyMyGold');
                $sms->user_id      =  $sm['user_id'];                        

                $sms->save();  
                    
                $images = $sm['images'] ?  explode(',', $sm['images']) : null;

                if ( !empty( $images )  > 0 ) {
                    foreach ( $images  as $image) {
                        try {

                            if ($image) {
                                // echo $image;
                                $img = Img::make($this->get_web_page($image));
                                $img->stream('jpg', 100);
                                $name = uniqid(true).'.o.jpg';
                                Storage::disk('DO')->put('buymygold/images/sms/'. $name, $img, 'public');
                                $image  = env('DO_URL').'buymygold/images/sms/'.$name;
                                $imgs= new Image(['url' => $image, 'rank' => 1]);
                                $sms->images()->save($imgs);
                            }

                        } catch(\Exception $e) {
                            echo $e->getMessage();
                        }

                    }
                }

                $bar->advance();
            }

            $bar->finish();
        }
    }


    public function get_web_page( $url ) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $a = curl_exec($ch);
        if(preg_match('#Location: (.*)#', $a, $r))
        return  $l = trim($r[1]);
        
    }  

    

}
