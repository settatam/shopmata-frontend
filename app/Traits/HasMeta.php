<?php

namespace App\Traits;

use App\Models\Meta;

trait HasMeta
{

    public function meta() {

        return $this->morphMany(Meta::class, 'metaable');

    }

    public function getMeta($field) {
        $meta = $this->meta->firstWhere('field', $field);
        if(null !== $meta) {
            return $meta->value;
        }
        return null;
    }

    public function addOrUpdateMeta($field, $value) {
        $meta = $this->meta()->firstOrNew([
            'field' => $field
        ]);

        $meta->value = $value;
        $meta->save();

        return $meta;
    }

}

