<?php

namespace App\Console\Commands\OneOffs;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Image;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use App\Models\Store;

class LoadBuyMyGoldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:buymygold';

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
        $this->stores = Store::whereIn('name', ['BuyMyGold', 'SellMyJewelry'])->get()->pluck('id', 'name');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://buymygold.com/api/transactions');
        $data = $response->body();
        if($orders = json_decode($data, true)) {
            foreach ($orders['orders'] as $order)
            $transaction = Transaction::firstOrNew(
                ['id' => $order['order_id']]
            );

            //Create the customer using the customer details in the endpoint
            $transaction->status_id = $order['status_id'];
            $transaction->dwt = $order['dwt'];
            $transaction->insurance_value = $order['insurance_value'];
            $transaction->payment_type_id = getPaymentType($order['payment_type']);
            $transaction->bin_location = $order['bin_location'];
            $transaction->store_id = $this->getStore($order['is_jewelry']);
            $transaction->kit_type = $order['kit_type'];
            $transaction->save();

            //Create the transaction history
            
            //Create eh transaction notes
            $transaction->notes()->create([
                'notes' => $order['notes'],
                'type' => $order['notes_private'] ? 'private' : 'public',
            ]);


        if($orders = json_decode($data, true)) {
            foreach ($orders['orders'] as $order) {
                $transaction = new Transaction;
                $transaction = Transaction::firstOrNew(
                    ['id' => $order['order_id']]
                );

                
                //Create the customer using the customer details in the endpoint
                $transaction->status_id = $order['status_id'];
                $transaction->user_id   = $order['user_id'];
                $transaction->tags = $order['tags'];

                //$transaction->insurance_value = $order['insurance_value'];
                //$transaction->payment_type_id = getPaymentType($order['payment_type']);
                //$transaction->bin_location = $order['bin_location'];
                //$transaction->store_id = 2;// $this->getStore($order['is_jewelry']);
                $transaction->created_at = $order['date_new'];// $this->getStore($order['is_jewelry']);
                $transaction->save();

                //Create the transaction history
            
                foreach ($transaction->histories as $history) {
                    $history->delete();
                }
            
                if ($order["date_update"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => "UPDATED" ]);
                }

                if ($order["date_fulfilled"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create(['event' => "FULFILLED"]);
                }

                if ($order["date_kit_denied"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => "KIT DENIED"]);
                }

                if ($order["date_shipment_received"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => "SHIPMENT RECEIVED" ]);
                }

                if ($order["date_shipment_declined"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => "SHIPMENT DECLINED" ]);
                }

                if ($order["date_shipment_returned"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => 'SHIPMENT RETURNED']);
                }

                if ($order["date_offer_given"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => 'OFFER GIVEN']);
                }

                if ($order["date_offer_accepted"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' =>'OFFER ACCEPTED' ]);
                }

                if ($order["date_offer_declined"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => 'OFFER DECLINED']);
                }

                if ($order["date_offer_paid"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => 'OFFER DECLINED']);
                } 
                
                foreach ($transaction->notes as $note) {
                    $note->delete();
                }
                
                //Create eh transaction notes
                $transaction->notes()->create(['notes' => $order['notes'],'type' => $order['notes_private'] ? 'private' : 'public' ]);


                $transaction->offer()->delete(); 
            

                $transaction->offer()->create(['offer' => $order['offer_amount']]);


                foreach ($transaction->items as $item) {
                    $item->delete();
                }

                $items = $order['items'] ? explode(',', $order['items']) : null;
                if ( !empty( $items )  > 0 ) {
                    foreach ( $items  as $item) {
                        $transaction->items()->create([
                           'item' => $item,
                           'is_jewelry' => $order['is_jewelry'],
                        ]);
                    }
                }


                // dd($transaction->images);


                // foreach ($transaction->images as $image) {
                //     $image->delete();
                // }

                $images = $order['photos'] ?  explode(',', $order['photos']) : null;
                if ( !empty( $images )  > 0 ) {
                    foreach ( $images  as $image) {
                        $imgs= new Image(['url' => $image, 'rank' => 1]);
                        $transaction->images()->save($imgs);
                    }
                } 
            }

        }

    }

    private function getStore($value) {
        return ($value) ? $this->stores['SellMyJewelry'] : $this->stores['BuyMyGold'];
    }
}
