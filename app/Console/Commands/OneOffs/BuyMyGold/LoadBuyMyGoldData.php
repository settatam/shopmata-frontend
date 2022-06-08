<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use App\Models\Address;
use App\Models\TransactionNote;
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
            try {
                foreach ($orders['orders'] as $order) {
                    $transaction = new Transaction;
                    $transaction = Transaction::firstOrNew(
                        ['id' => $order['order_id']]
                    );
                    //Create the customer using the customer details in the endpoint
//                    $transaction->id              = $order['order_id'];
                    $transaction->status_id       = ($order['status_id']) ? $order['status_id'] : 60;
                    $transaction->customer_id     = $order['user_id'];//Customer id
//                    $transaction->tags            = $order['tags'];
                    $transaction->comments        = $order['values'];
                    $transaction->insurance_value = $order['ship_insurance'];
                    $transaction->payment_method_id = $order['pay_method'];
                    //$transaction->bin_location = $order['bin_location'];
                    $transaction->store_id = $this->getStore($order['is_jewelry']);
                    $transaction->created_at = $order['date_new'];// $this->getStore($order['is_jewelry']);
                    $transaction->customer_categories = $order['items'];
                    $transaction->save();


                    //add customers
                    $customer = Customer::firstOrNew(
                        ['id' => $order['user_id']]
                    );

                    $names = explode(' ', $order["customer_name"], 2);

                    $customer->id                 = $order['user_id'];
                    $customer->email              = $order["customer_email"];
                    $customer->first_name         = data_get($names, 0);
                    $customer->last_name          = data_get($names, 1);
                    $customer->street_address     = $order["customer_address"];
                    $customer->city               = $order["customer_city"];
                    $customer->state_id           = $this->getStateId($order["customer_state"]);

                    $customer->store_id           = $this->getStore($order['is_jewelry']);
                    $customer->phone_number       = $order["customer_phone"];
                    $customer->lead_id            = isset($order["lead_id"]) && $order["lead_id"] != 0 ? $order["lead_id"]: null;
                    $customer->dob                = $order["customer_dob"];
                    $customer->password           = bcrypt($order['order_password']);
                    $customer->gender             = $order['customer_gender'];
                    $customer->customer_notes     = $order['customer_notes'];


                    $customer->accepts_marketing  =   1;
                    $customer->created_at = $order['date_new'];
                    $customer->save();
                    //Create the transaction history


                    $transaction_payment_address = new TransactionPaymentAddress;
                    $transaction_payment_address = TransactionPaymentAddress::firstOrNew(
                        ['transaction_id' => $order['order_id'] ]
                    );

                    $transaction_payment_address->transaction_id         =  $order['order_id'];
                    $transaction_payment_address->customer_id            =  $customer->id;
                    $transaction_payment_address->payment_type_id        =  $order["pay_method"];
                    $transaction_payment_address->paypal_address         =  $order["paypal_address"];
                    $transaction_payment_address->bank_address           =  $order["ach_bank_address"];
                    $transaction_payment_address->bank_address_city      =  $order["ach_bank_address_city"];
                    $transaction_payment_address->bank_address_state_id  =  $this->getStateId($order["ach_bank_address_state"]);
                    $transaction_payment_address->bank_address_zip       =  $order["ach_bank_address_zip"];
                    $transaction_payment_address->routing_number         =  $order["ach_routing_number"];
                    $transaction_payment_address->bank_name              =  $order["ach_bank_name"];
                    $transaction_payment_address->account_number         =  $order["ach_account_number"];
                    $transaction_payment_address->account_name           =  $order["ach_account_name"];
                    $transaction_payment_address->account_type           =  $order["ach_account_type"];
                    $transaction_payment_address->venmo_address          =  $order["venmo_address"];
                    $transaction_payment_address->check_name             =  $order["check_payable"];
                    $transaction_payment_address->check_address          =  $order["check_address"];
                    $transaction_payment_address->check_city             =  $order["check_city"];
                    $transaction_payment_address->check_zip              =  $order["check_zip"];
                    $transaction_payment_address->check_state_id         =  $this->getStateId($order["check_state"]);
                    $transaction_payment_address->save();

                    $transAddress = Address::firstOrNew([
                        'addressable_id' => $transaction->id,
                        'addressable_type' => Transaction::class
                    ]);

                    $address = [
                        'address' => $order["customer_address"],
                        'address2' => $order["customer_address2"],
                        'city' => $order["customer_city"],
                        'store_id' => $customer->store_id,
                        'first_name' => data_get($names, 0),
                        'last_name' => data_get($names, 1),
                        'phone' => $order["customer_phone"],
                        'country' => 'US',
                        'zip' => $order["customer_zip"],
                        'addressable_id' => $transaction->id,
                        'addressable_type' => Transaction::class,
                        'state' => $order["customer_state"],
                        'state_id' => $this->getStateId($order["customer_state"]),
                        'dob'  => $order["customer_dob"],
                    ];

                    $transAddress->fill($address);
                    $transAddress->save();


                    $cusAddress = Address::firstOrNew([
                        'addressable_id' => $customer->id,
                        'addressable_type' => Customer::class
                    ]);

                    $address = [
                        'address' => $order["customer_address"],
                        'address2' => $order["customer_address2"],
                        'city' => $order["customer_city"],
                        'store_id' => $customer->store_id,
                        'first_name' => data_get($names, 0),
                        'last_name' => data_get($names, 1),
                        'phone' => $order["customer_phone"],
                        'country' => 'US',
                        'zip' => $order["customer_zip"],
                        'addressable_id' => $customer->id,
                        'addressable_type' => Customer::class,
                        'state' => $order["customer_state"],
                        'state_id' => $this->getStateId($order["customer_state"]),
                        'dob'  => $order["customer_dob"],
                    ];

                    $cusAddress->fill($address);
                    $cusAddress->save();


                    foreach ($transaction->histories as $history) {
                        $history->delete();
                    }

                    if ($order["date_update"]  !== "0000-00-00 00:00:00"){
                        $transaction->addActivity([
                            'event' => "UPDATED",
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

                    if($order['notes_private']) {
                        TransactionNote::create([
                            'transaction_id' => $transaction->id,
                            'type' => TransactionNote::PRIVATE_TYPE,
                            'notes' => $order['notes_private']
                        ]);
                    }

                    if($order['notes_private']) {
                        TransactionNote::create([
                            'transaction_id' => $transaction->id,
                            'type' => TransactionNote::PUBLIC_TYPE,
                            'notes' => $order['notes_public']
                        ]);
                    }

                    if ($transaction->offers->count()) {
                        foreach ($transaction->offers as $offer) {
                            $offer->delete();
                        }
                    }

                    $transaction->offers()->create(
                        [
                            'offer' => $order['offer_amount']
                        ]
                    );

                    foreach ($transaction->images as $image) {
                        $image->delete();
                    }

                    $images = $order['photos'] ?  explode(',', $order['photos']) : null;

                    if ( !empty( $images )  > 0 ) {
                        foreach ( $images  as $image) {
                            try {
                                if ($image) {
                                    $file = 'https://s3.amazonaws.com/wbgasphotos/uploads/assets/'.substr($image,0,2)."/".substr($image,2,2)."/".$image.'.o.jpg';
                                    $imgs= new Image(['url' => $file, 'rank' => 1]);
                                    $transaction->images()->save($imgs);
                                }

                            } catch(\Exception $e) {
                                echo $e->getMessage();
                            }

                        }
                    }
                    $bar->advance();
                }
            } catch(\Exception $e) {
                dd($e->getMessage());
            }

             $bar->finish();

        }

    }

    private function getStore($value)
    {
        if ($value) {
            $store = Store::where('name','SellMyJewelry')->first();
        } else {
            $store = Store::where('name','BuyMyGold')->first();
        }

        if (null !== $store) {
            return $store->id;
        }

        return null;
    }


    private function getStateId($state_abreviation)
    {
        $state = State::where('code', $state_abreviation)->first();
        return null !== $state ? $state->id : null;
    }

}



