<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariant extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'sku'=>$this->sku,
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'product_id'=>$this->product_id,
            'attributes'=> new ProductAttribute($this->attributes)
        ];
    }
}
