<?php

namespace App\Widget;

use App\Models\Customer;

class LeadTypeCheckBoxes extends CheckBox
{
    public function options($filter) {
        $lead_types = Customer::has('transactions')->select(\DB::raw('customers.lead_id, COUNT(customers.lead_id) AS `leadIdCount`'))->with('lead')->groupBy('lead_id')->get();
        return $lead_types->map(function (Customer $customer) use ($filter) {
            return [
                'label' => $customer->lead_id . ' - '  . ($customer->leadIdCount),
                'value' => $customer->lead_id
            ];
        });
    }
}
