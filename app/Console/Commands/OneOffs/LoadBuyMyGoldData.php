<?php

namespace App\Console\Commands\OneOffs;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Transaction;

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
        $response = Http::get('https://buymygold.com/api/transactions');
        $data = $response->body();
        if($r = json_decode($data, true)) {

        }
        dd($body);

    }
}
