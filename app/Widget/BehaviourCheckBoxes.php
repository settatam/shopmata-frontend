<?php


namespace App\Widget;

use App\Models\Customer;

class BehaviourCheckBoxes extends CheckBox
{
    public function options($filter) {
        $b = Customer::withGroupedBehavior()->get();
        return $b->map(function (Customer $customer) use ($filter) {
            return [
                'label' => $customer->name . ' - '  . ($customer->tagIdCount),
                'value' => $customer->tag_id
            ];
        });
    }
}


