<?php

namespace App\Console\Commands\OneOffs\BuyMyGold;

use App\Models\SeoTraffic;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
                $trans = Transaction::whereHas('customer', function($q) use ($customer, $traffic) {
                    $q->where('email', $customer['customer_email']);
                })->update(['seo_traffic_id'=>$traffic->id]);
                $bar->advance();
            }

        }
        $bar->finish();
    }
}
