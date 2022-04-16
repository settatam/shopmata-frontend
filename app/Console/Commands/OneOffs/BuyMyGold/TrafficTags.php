<?php
namespace App\Console\Commands\OneOffs\BuyMyGold;

ini_set('memory_limit', -1);

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\SeoTraffic;

class TrafficTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:traffictags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load Traffic Tags';

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
        $response = Http::get('https://buymygold.com/api/sms?q=traffic');
        $data = $response->body();
        $d = json_decode($data, true);

        $fillable = [
            'source',
            'campaign_id',
            'creative_id',
            'keyword',
            'matchtype',
            'adposition',
            'device',
            'device_model'
        ];

        $bar = $this->output->createProgressBar(count($d['data']));

        foreach($d['data'] as $traffic) {
            $t = SeoTraffic::firstOrNew(['id'=>$traffic['tag_id']]);
            $t->created_at = $traffic['tag_date'];
            foreach($fillable as $fill) {
                $t->{$fill} = $traffic[$fill];
            }

            $t->save();
            $bar->advance();
        }
        $bar->finish();

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
    }
}
