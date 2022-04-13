<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Store;
use App\Models\Sms;
use Illuminate\Support\Facades\Storage;
use Image as Img;
use App\Models\Image;





class LoadSmsImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:smsimages';

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
        $sms = Sms::all();
        if ($sms){
            $bar = $this->output->createProgressBar($sms->count());
            foreach ($sms as $sm ) {
                $images = $sm->tem_url ?  explode(',', $sm->tem_url) : null;

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
                                $sm->images()->save($imgs);
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
