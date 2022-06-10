<?php


namespace App\Widget;

use App\Models\Transaction;
use App\Models\StoreTag;

class BehaviourCheckBoxes extends CheckBox
{
    public function options($filter) {

       $behaviors =  Transaction::search($filter)
            ->join('customers', 'customer_id', '=', 'customers.id')
            ->join('store_tags', 'store_tags.tagable_id', 'customers.id')
            ->where('type', 'behavior')
            ->join('tags', 'tags.id', 'store_tags.tag_id')
            ->where('store_tags.tagable_type', 'App\Models\Customer')
            ->selectRaw("tag_id, tags.name, COUNT(tag_id) AS `behaviorCount`")
            ->groupBy('store_tags.tag_id')
            ->get();

        return $behaviors->map(function ($tag) use ($filter) {
            return [
                'label' => $tag->name . ' -  ' . $tag->behaviorCount,
                'value' => $tag->tag_id
            ];
        });
    }
}


