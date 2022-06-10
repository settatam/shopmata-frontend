<?php

namespace App\Widget;

use App\Models\Transaction;
use App\Models\StoreTag;

class BehaviourCheckBoxes extends CheckBox
{
    public function options($filter) {

       $behaviors =  Transaction::query()
            ->join('customers', 'customer_id', '=', 'customers.id')
            ->join('store_tags', 'store_tags.tagable_id', 'customers.id')
            ->where('store_tags.tagable_type', 'App\Models\Customer')
            ->selectRaw("tag_id, COUNT(tag_id) AS `behaviorCount`")
            ->groupBy('store_tags.tag_id')
            ->get();

        return $behaviors->map(function ($tag) use ($filter) {
            return [
                'label' => $tag->tag_id,
                'value' => $tag->behaviorCount
            ];
        });
    }
}
