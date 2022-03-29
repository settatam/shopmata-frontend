<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\Helper;
use App\Models\TransactionItem;



class LoadItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:transactionitems';

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
        $data   =  Helper::getApiData('https://buymygold.com/api/sms?q=items');

        if ($data){
            $bar = $this->output->createProgressBar(count($data['data']));
            
            foreach ($data['data'] as $transaction_item ) {

                $transactionItem = new TransactionItem;
                $transactionItem = $transactionItem::firstOrNew(
                    ['id' => $transaction_item['id']]
                );
               
                $transactionItem->id              =  $transaction_item['id'];
                $transactionItem->transaction_id  =  $transaction_item['order_id'];
                $transactionItem->description     =  $transaction_item['description'];
                $transactionItem->price           =  $transaction_item['price'];
                $transactionItem->dwt             =  $transaction_item['dwt']  ?? 0;
                $transactionItem->created_at      =  $transaction_item['created_at'];
                $transactionItem->inotes          =  $transaction_item['inotes'];
                $transactionItem->category_id     =  $transaction_item['type_id'];
                $transactionItem->category        =  $transaction_item['type'];
                $transactionItem->override        =  $transaction_item['override'];
                $transactionItem->quantity        =  $transaction_item['quantity'];
                $transactionItem->override_price  =  $transaction_item['override_price'];
                $transactionItem->save();  
                $images = $transactionItem['pictures'] ?  explode(',', $order['pictures']) : null;

                if ( !empty( $images )  > 0 ) {
                    foreach ( $images  as $image) {
                        try {
                            $image = str_replace('\"', '', $image);
                            $file = 'https://s3.amazonaws.com/wbgasphotos/uploads/assets/'.substr($image,0,2)."/".substr($image,2,2)."/".$image.'.o.jpg';
                            $img = $image.'.o.jpg';
                            $dest = storage_path().'/'.$img;
                            copy($file, $dest);
                            if ( Storage::disk('DO')->put('buymygold/images/items/'.$img, fopen($dest, 'r+'), 'public')) {
                                Storage::delete($dest);
                            }
                            $image  = env('DO_URL').'buymygold/images/items/'.$img;
                            $imgs= new Image(['url' => $image, 'rank' => 1]);
                            $transactionItem->images()->save($imgs);
                        } catch(\Exception $e) {

                        }

                    }
                }
                $bar->advance();
            }

            $bar->finish();
        }

    }

}
