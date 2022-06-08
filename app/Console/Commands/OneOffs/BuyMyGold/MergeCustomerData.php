<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use App\Models\SeoTraffic;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Address;

class MergeCustomerData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'merge:customer';

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
        $response = Http::get('https://buymygold.com/api/sms?q=customer');
        $data = $response->body();
        $d = json_decode($data, true);

        $bar = $this->output->createProgressBar(count($d['data']));

        foreach($d['data'] as $customer) {
            if(!$customer['tag_id']) {
                $bar->advance();
                continue;
            }
            $traffic = SeoTraffic::find($customer['tag_id']);
            if(null !== $traffic) {
                $trans = Transaction::whereHas('customer', function($q) use ($customer) {
                    $q->where('email', $customer['customer_email']);
                })->first();
                if(null !== $trans) {

                    $trans->seo_traffic_id = $traffic->id;
                    $trans->save();

//                    $trans->address->firstOrNew([
//                        'addressable_id' => $trans->id
//                    ]);
//
//                    $trans->address->address = $customer['customer_address'];
//                    $trans->address->address2 = $customer['customer_address2'];
//                    $trans->address->phone = $customer['customer_phone'];
//                    $trans->address->city = $customer['customer_city'];
//                    $trans->address->state = $customer['customer_state'];
//                    $trans->address->postal_code = $customer['customer_zip'];
//                    $trans->address->addressable_type = Transaction::class;
//                    $trans->address->save();

                }
                $bar->advance();
            }

        }
        $bar->finish();
    }
}
