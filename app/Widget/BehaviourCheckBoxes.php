<?php

namespace App\Widget;

use App\Models\Transaction;
use App\Models\StoreTag;

class BehaviourCheckBoxes extends CheckBox
{
    public function options($filter) {
        $behaviors  = StoreTag::where('type', 'behavior')
            ->withGroupBehavior()
            ->get();
        dd($behaviors);
        return $behaviors->map(function (StoreTag $tag) use ($filter) {
            return [
                'label' => $tag,
                'value' => 0
            ];
        });
    }
}
