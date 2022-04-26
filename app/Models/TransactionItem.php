<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'is_jewelry'
    ];



    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
	}


    public static function addItem($request)
    {
        $transactionItem =  new TransactionItem;
        $transactionItem->transaction_id  = $request->transaction_id;
        $transactionItem->category_id     = $request->category_id;
        $transactionItem->price           = $request->price;
        $transactionItem->dwt             = $request->dwt;
        $transactionItem->description     = $request->description;
        $transactionItem->inotes          = $request->inotes;
        $transactionItem->override_price  = $request->override_price;
        $transactionItem->item            = $request->item;
        $transactionItem->save();
        if ( $request->images){
            // foreach ($request->images as $key => $image) {
            //     $imgs= new Image(['url' => $l_image, 'thumbnail' =>  $tn_image, 'rank' => 1]);
            //     $transactionItem->images()->save($imgs);
            // }

        }
        return $transactionItem;
	}
}
