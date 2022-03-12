<?php

namespace App\Validators\Product;

use App\Exceptions\InvalidInputException;
use App\Models\Brand;
use App\Validators\ValidatorWrapper;
use Illuminate\Http\Request;

trait BrandsControllerValidators
{

    public function validateStoreRequest(Request $request) {
        $store_id = session()->get('store_id');
        $validated = ValidatorWrapper::wrap($request, [
            "name" => ["required", "string",],
        ]);
        if(Brand::where([
            ['name', '=', $request->input("name")],
            ['store_id', '=', $store_id]
        ])->exists()) {
            throw new InvalidInputException("This brand already exists on the system");
        }
    }
}
