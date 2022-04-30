<?php

namespace App\Console\Commands\OneOffs;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ShippingLabel;
use App\Models\Transaction;

class LoadShippingLabels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:fedex';

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
        ini_set('memory_limit', -1);
        $response = Http::get('https://buymygold.com/api/sms?q=fedex');
        $data = $response->body();

        if($orders = json_decode($data, true)) {
            $bar = $this->output->createProgressBar(count($orders['data']));
            foreach($orders['data'] as $label) {

                $r = [
                    'tracking_number' => $label['tracking_num'],
                    'shipping_company_id' => 1,
                    'shippable_type' => Transaction::class,
                    'shippable_id' => $label['order_id'],
                    'raw_data' => $label['raw_data'],
                    'to_customer' => $label['address_is'] == 'to' ? true : false,
                    'tracking_info' => $label['tracking_info']
                ];

                ShippingLabel::create($r);
                $bar->advance();
            }
        }

        $bar->finish();
    }
}
