<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Customer;
use App\Models\Image;
use App\Models\Transaction;
use App\Models\Store;
use App\Models\State;
use App\Models\TransactionPaymentAddress;


use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


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
            $bar = $this->output->createProgressBar(count($orders['orders']));
            foreach ($orders['orders'] as $order) {
                $transaction = new Transaction;
                $transaction = Transaction::firstOrNew(
                    ['id' => $order['order_id']]
                );
                //Create the customer using the customer details in the endpoint
                $transaction->id = $order['order_id'];
                $transaction->status_id = $order['status_id'];
                $transaction->user_id   = $order['user_id'];//Customer id
                $transaction->tags = $order['tags'];
                $transaction->comments = $order['values'];
                $transaction->insurance_value = $order['ship_insurance'];
                $transaction->payment_method_id = $order['pay_method'];
//              $transaction->bin_location = $order['bin_location'];
                $transaction->store_id = 2;
                //$transaction->store_id = $this->getStore($order['is_jewelry']);

                $transaction->created_at = $order['date_new'];// $this->getStore($order['is_jewelry']);
                $transaction->save();

                $transaction_payment_address = new TransactionPaymentAddress;

                $transaction_payment_address = TransactionPaymentAddress::firstOrNew(
                    ['transaction_id' => $transaction->id ],
                );
                
                $transaction_payment_address->payment_type_id           =  $transaction->pay_method;  
                $transaction_payment_address->check_payable           =  $transaction->check_payable;
                $transaction_payment_address->check_address           =  $transaction->check_address;
                $transaction_payment_address->check_city              =  $transaction->check_city;
                $transaction_payment_address->check_state             =  $transaction->check_state;
                $transaction_payment_address->check_zip               =  $transaction->check_zip;
                $transaction_payment_address->paypal_address          =  $transaction->paypal_address;
                $transaction_payment_address->ach_bank_name           =  $transaction->ach_bank_name;   
                $transaction_payment_address->ach_bank_address        =  $transaction->ach_bank_address;
                $transaction_payment_address->ach_bank_address_city   =  $transaction->ach_bank_address_city;  
                $transaction_payment_address->ach_bank_address_state  =  $transaction->ach_bank_address_state;
                $transaction_payment_address->ach_bank_address_zip    =  $transaction->ach_bank_address_zip;
                $transaction_payment_address->ach_routing_number      =  $transaction->ach_routing_number;
                $transaction_payment_address->ach_account_number      =  $transaction->ach_account_number;   
                $transaction_payment_address->ach_account_name        =  $transaction->ach_account_name;  
                $transaction_payment_address->ach_account_type        =  $transaction->ach_account_type;
                $transaction_payment_address->venmo_address           =  $transaction->venmo_address;
                $transaction_payment_address->save();

                //add customers

                $customer = Customer::firstOrNew(
                    ['id' => $order['user_id']]
                );
                $customer->id           = $order['user_id'];
                $customer->email        = $order["customer_email"];
                $customer->first_name   = $order["customer_name"];
                $customer->address      = $order["customer_address"];
                $customer->city         = $order["customer_city"];
                $customer->state_id     = $this->getStateId($order["customer_state"]);
                $customer->store_id     = 2; //belongs to seth;
              //$transaction->store_id = $this->getStore($order['is_jewelry']);

                $customer->zip          = $order["customer_zip"];
                $customer->phone_number = $order["customer_phone"];
                $customer->address2     = $order["customer_address2"];
                $customer->dob          = $order["customer_dob"];
                $customer->password     = bcrypt($order['order_password']);
                $customer->accepts_marketing    =   1;
                $customer->created_at = $order['date_new'];// $this->getStore($order['is_jewelry']);


                $customer->save();
                //Create the transaction history

                foreach ($transaction->histories as $history) {
                    $history->delete();
                }

                if ($order["date_update"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([
                        'event' => "UPDATED" ,
                        'created_at' => $order["date_update"]
                    ]);
                }

                if ($order["date_fulfilled"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([
                        'event' => "FULFILLED" ,
                        'created_at' => $order["date_fulfilled"]
                    ]);
                }

                if ($order["date_kit_denied"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([
                        'event' => "KIT DENIED" ,
                        'created_at' => $order["date_kit_denied"]
                    ]);
                }

                if ($order["date_shipment_received"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([
                        'event' => "SHIPMENT RECEIVED",
                        'created_at' => $order["date_shipment_received"]
                    ]);
                }

                if ($order["date_shipment_declined"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([
                        'event' => "SHIPMENT DECLINED",
                        'created_at' => $order["date_shipment_declined"]
                    ]);
                }

                if ($order["date_shipment_returned"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([
                        'event' => 'SHIPMENT RETURNED',
                        'created_at' => $order["date_shipment_returned"]
                    ]);
                }

                if ($order["date_offer_given"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([
                        'event' => 'OFFER GIVEN',
                        'created_at' => $order["date_offer_given"]
                    ]);
                }

                if ($order["date_offer_accepted"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' =>'OFFER ACCEPTED', 'created_at' => $order["date_offer_accepted"] ]);
                }

                if ($order["date_offer_declined"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => 'OFFER DECLINED', 'created_at' => $order["date_offer_declined"]]);
                }

                if ($order["date_offer_paid"]  !== "0000-00-00 00:00:00"){
                    $transaction->histories()->create([ 'event' => 'OFFER DECLINED', 'created_at' => $order["date_offer_paid"]]);
                }

                foreach ($transaction->notes as $note) {
                    $note->delete();
                }

                //Create eh transaction notes
                $transaction->notes()->create([
                    'notes' => $order['notes'],
                    'type' => $order['notes_private'] ? 'private' : 'public'
                ]);

                if ($transaction->offers->count()) {
                    foreach ($transaction->offers as $offer) {
                        $offer->delete();
                    }
                }
                

                $transaction->offers()->create(['offer' => $order['offer_amount']]);


                foreach ($transaction->images as $image) {
                    $image->delete();
                }

                $images = $order['photos'] ?  explode(',', $order['photos']) : null;

                if ( !empty( $images )  > 0 ) {
                    foreach ( $images  as $image) {
                        try {
                            if ($image) {
                                $file = 'https://s3.amazonaws.com/wbgasphotos/uploads/assets/'.substr($image,0,2)."/".substr($image,2,2)."/".$image.'.o.jpg';
                                $img = $image.'.o.jpg';
                                $dest = storage_path().'/'.$img;
                                copy($file, $dest);
                                if ( Storage::disk('DO')->put('buymygold/images/items/'.$img, fopen($dest, 'r+'), 'public')) {
                                    Storage::delete($dest);
                                }
                                $image  = env('DO_URL').'buymygold/images/items/'.$img;
                                $imgs= new Image(['url' => $image, 'rank' => 1]);
                                $transaction->images()->save($imgs);
                            }
                            
                        } catch(\Exception $e) {
                            dd($e->getMessage());
                        }

                    }
                }
                $bar->advance();
            }

            $bar->finish();

        }

    }

    private function getStore($value) {
        return ($value) ? $this->stores['SellMyJewelry'] : $this->stores['BuyMyGold'];
    }


    private function getStateId($state_abreviation)
    {
        $state = State::where('code', $state_abreviation)->first();
        return null !== $state ? $state->id : null;
    }

}
