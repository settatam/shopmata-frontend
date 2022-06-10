<?php

namespace App\Widget;

use App\Models\Transaction;

class TagsCheckBoxes extends CheckBox
{
    public function options($filter) {
        $tags  = Transaction::withGroupedTags()->get();
        return $tags->map(function ($tag) use ($filter) {
            return [
                'label' => $tag->name . ' -  ' . $tag->tagCount,
                'value' => $tag->tag_id
            ];
        });
    }
}
