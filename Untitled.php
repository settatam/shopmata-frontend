<?php
use App\Models\Transaction;
use App\Models\Activity;
use App\Models\Address;

$a = Address::all();

foreach($a as $b) {
  $b->postal_code = $b->zip;
  $a->save();
}


$t = Transaction::find(11627);
$changes = ['status_id'=>3, 'bin_location'=>'ART123'];
$t->doUpdate($changes);
dd($t);





