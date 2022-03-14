<?php

namespace App\Console\Commands\OneOffs;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Transaction;
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

        }

    }

    private function getStore($value) {
        return ($value) ? $this->stores['SellMyJewelry'] : $this->stores['BuyMyGold'];
    }
}
