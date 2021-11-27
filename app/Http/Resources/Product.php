<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'title'=>$this->title,
            'description'=>$this->description,
            'date_created'=>$this->created_at,
            'weight'=>$this->weight,
            'compare_at_price'=>$this->compare_at_price,
            'handle'=>$this->slug,
            'date_available'=>$this->date_available,
            'is_published'=>$this->is_published,
            'variants'=> new ProductVariantCollection($this->variants)
        ];
    }
}
