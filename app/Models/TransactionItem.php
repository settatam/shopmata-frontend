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
        $transactionItem->category_id     = $request->transaction_id;
        $transactionItem->price           = $request->transaction_id;
        $transactionItem->dwt             = $request->customer_id;
        $transactionItem->description     = $request->customer_id;
        $transactionItem->inotes          = $request->customer_id;
        $transactionItem->override_price  = $request->customer_id;
        $transactionItem->item            = $request->item;
        $transactionItem->save();
        $image  = FileUploader::upload($request);
        if ( isset($image[0]['thumb']) ){
            $l_image = $image[0]['thumb'];
            $tn_image = $image[0]['large'];
            $imgs= new Image(['url' => $l_image, 'thumbnail' =>  $tn_image, 'rank' => 1]);
            $transactionItem->images()->save($imgs);
        }

        return $transactionItem;
	}
}
