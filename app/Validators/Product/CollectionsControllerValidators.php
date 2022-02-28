<?php

namespace App\Validators\Product;

use App\Validators\ValidatorWrapper;
use Illuminate\Http\Request;

trait CollectionsControllerValidators
{
    public function validateCreateCollectionRequest(Request $request) {
        ValidatorWrapper::wrap($request, [
            'name' => ['string', 'required', 'bail'],
            'description' => [''],
            ''
        ]);
    }
}
