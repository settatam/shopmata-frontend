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


class SplitCustomerNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:splitnames';

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
        $customers = Customer::where('last_name', null)->get();
        if($customers) {
            $bar = $this->output->createProgressBar($customers->count());
            foreach ($customers as $customer) {
                $n =  preg_replace('!\s+!', ' ', $customer->first_name);
                $n = explode(" ", $n);
                $customer->first_name = isset($n[0])  ? $n[0] :  null;
                $customer->last_name  = isset($n[1]) ? $n[1]  : null;              
                $customer->save();
                $bar->advance();
            }
            $bar->finish();
        }

    }

    


    private function getStateId($state_abreviation)
    {
        $state = State::where('code', $state_abreviation)->first();
        return null !== $state ? $state->id : null;
    }

}
