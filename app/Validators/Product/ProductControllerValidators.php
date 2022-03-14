<?php

namespace App\Validators\Product;

use App\Exceptions\InvalidInputException;
use App\Exceptions\ServerErrorException;
use App\Models\Currency;
use App\Validators\ValidatorWrapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Product;

trait ProductControllerValidators
{
    public function validateStoreRequest(Request $request)
    {
        $currencies = Currency::all()->pluck('code');
        if (!count($currencies)) {
            throw new ServerErrorException("There are no currencies in the database!");
        }
        $validated = ValidatorWrapper::wrap($request, [
            "title" => ["required", "string", "bail"],
            "description" => ["required", "string", "bail"],
            "weight" => ["numeric", "nullable", "bail"],
            "price" => ["numeric", "required", "bail",],
            "compare_at_price" => ["numeric", "nullable", "bail", ],
            "store_id" => ["numeric", "required", "bail", "exists:stores,id"],
            "handle" => ["string", "nullable", "bail",],
            "upc" => ["nullable", "string", "bail",],
            "ean" => ["nullable", "string", "bail",],
            "jan" => ["nullable", "string", "bail",],
            "isbn" => ["nullable", "string", "bail",],
            "mpn" => ["nullable", "string", "bail",],
            "location" => ["nullable", "string", "bail",],
            "tax_class" => ["nullable", "string", "bail"],
            "length" => ["nullable", "numeric", "bail",],
            "width" => ["nullable", "numeric", "bail",],
            "height" => ["nullable", "numeric", "bail",],
            "brand_id" => ["nullable", "numeric", "bail",
                Rule::exists('brands', 'id')
                    ->where(function ($query) use ($request) {
                        $query->where([
                            'store_id' => $request->input('store_id')
                        ]);
                    })],
            "sort_attribute" => ["nullable", "numeric", "bail"],
            "has_variants" => ["boolean", "required", "bail",],
            "country_of_origin" => ["nullable", "string", "bail",],
            "step" => ["string", "nullable", "bail",],
            "sell_out_of_stock" => ["nullable", "boolean", "bail",],
            "quantity" => ["nullable", "numeric", "bail",],
            "min_quantity" => ["nullable", "numeric", "bail",],
            "track_quantity" => ["nullable", "boolean", "bail",],
            "charge_taxes" => ["nullable", "boolean", "bail",],
            "custom_product_type_id" => ["nullable", "numeric", "bail",
                Rule::exists("custom_product_types", "id")
                    ->where(function ($query) use ($request) {
                        $query->where([
                            'store_id' => $request->input('store_id')
                        ]);
                    })],
            "product_type_id" => ["nullable", "numeric", "bail", "exists:product_types,id"],
            "publish_product" => ["nullable", "boolean", "bail",],
            "date_available" => ["nullable", "string", "date_format:m-d-Y"],
            "seo_page_title" => ["nullable", "string", "bail"],
            "seo_description" => ["nullable", "string", "bail"],
            "assets" => ['required',],
            "assets.*.url" => ["string", "bail", "required"],
            "assets.*.thumb" => ["string", "bail", "nullable",],
            "assets.*.description" => ["string", "bail", "nullable"],
            "assets.*.rank" => ["numeric", "integer", "bail", "nullable"],
        ], [
            "exists" => "The :attribute entered does not exist."
        ], [
            "store_id" => "store",
            "brand_id" => "brand",
            "product_type_id" => "product type",
            "custom_product_type_id" => "custom product type",
        ])->toArray();
        if(Product::where([
            ['title', 'LIKE', $request->input('title')],
            ['store_id', '=', $request->input('store_id')]
        ])->exists()) {
            throw new InvalidInputException("A product already exists with this title in your store.");
        }
        if ($request->input('has_variants')) {
            $variantInputs = ValidatorWrapper::wrap($request, [
                "available_variant_attributes" => ["required", "bail"],
                "available_variant_attributes.*" => ["required", "string"],
                "variants.*.sku" => ["string", "nullable", "bail", Rule::unique('product_variants')
                    ->where(function ($query) use ($request) {
                        $query->where('store_id', $request->input('store_id'));
                    })],
                "variants.*.price" => ["numeric", "required", "bail",],
                "variants.*.quantity" => ["numeric", "required", "bail",],
                "variants.*.barcode" => ["string", "nullable", "bail",],
                "variants.*.compare_at_price" => ["numeric", "nullable", "bail"],
                "variants.*.attributes" => ["required",],
                "variants.*.attributes.*.attribute" => ["required", "string", "bail"],
                "variants.*.attributes.*.value" => ["required", "string", "bail"],
                "variants.*.assets" => ["nullable", "bail",],
                "variants.*.assets.*.url" => ["string", "bail", "required"],
                "variants.*.assets.*.thumb" => ["string", "bail", "nullable",],
                "variants.*.assets.*.description" => ["string", "bail", "required"],
                "variants.*.assets.*.rank" => ["numeric", "integer", "bail", "required"],
                // TODO: Properly define how images & assets would be handled
            ])->toArray();
            $skuHashTable = [];
            foreach ($request->input('variants') as $variant) {
                $uniqueHashTable = [];
                if (array_key_exists('assets', $variant)) {
                    foreach ($variant['assets'] as $asset) {
                        if (array_key_exists($asset['url'], $uniqueHashTable)) {
                            throw new InvalidInputException("Product variant images must be unique!");
                        }
                        $uniqueHashTable[$asset['url']] = true;
                    }
                }
                if (array_key_exists('sku', $variant)) {
                    if (array_key_exists('sku', $skuHashTable)) {
                        throw new InvalidInputException("The sku for each variant has to be unique");
                    }
                    $skuHashTable[$variant['sku']] = true;
                }
            }
            $validated = array_merge($validated, $variantInputs);
        } else {
            $extraInputs = ValidatorWrapper::wrap($request, [
                "sku" => ["string", "nullable", "bail", Rule::unique('product_variants')
                    ->where(function ($query) use ($request) {
                        $query->where('store_id', $request->input('store_id'));
                    })],
                "barcode" => ["string", "nullable", "bail",],
            ])->toArray();
            $validated = array_merge($validated, $extraInputs);
        }
        // Make sure asset urls are unique
        $uniqueHashTable = [];
        foreach ($request->input('assets') as $asset) {
            if (array_key_exists($asset['url'], $uniqueHashTable)) {
                throw new InvalidInputException("Product images must be unique!");
            }
            $uniqueHashTable[$asset['url']] = true;
        }
        return $validated;
    }

    public function validateUploadCSVRequest(Request $request)
    {
        $validated = ValidatorWrapper::wrap($request, [
            'products' => ['file', 'required', 'max:5000']
        ]);
    }

    public function validateCSVRow(array $row)
    {
        $validated = Validator::make($row, [
            "title" => ["required", "string", "bail"],
            "description" => ["required", "string", "bail"],
            "weight" => ["numeric", "nullable", "bail"],
            "price" => ["numeric", "required", "bail",],
            "compare_at_price" => ["numeric", "nullable", "bail", ],
            "store_id" => ["numeric", "required", "bail", "exists:stores,id"],
            "handle" => ["string", "required", "bail",],
            "upc" => ["nullable", "string", "bail",],
            "ean" => ["nullable", "string", "bail",],
            "jan" => ["nullable", "string", "bail",],
            "isbn" => ["nullable", "string", "bail",],
            "mpn" => ["nullable", "string", "bail",],
            "location" => ["nullable", "string", "bail",],
            "tax_class" => ["nullable", "string", "bail"],
            "length" => ["nullable", "numeric", "bail",],
            "width" => ["nullable", "numeric", "bail",],
            "height" => ["nullable", "numeric", "bail",],
            "brand_id" => ["nullable", "numeric", "bail",
                Rule::exists('brands', 'id')
                    ->where(function ($query) use ($row) {
                        $query->where([
                            'store_id' => $row['store_id']
                        ]);
                    })],
            "sort_attribute" => ["nullable", "numeric", "bail"],
            "has_variants" => ["boolean", "required", "bail",],
            "country_of_origin" => ["nullable", "string", "bail",],
            "step" => ["string", "nullable", "bail",],
            "sell_out_of_stock" => ["nullable", "boolean", "bail",],
            "quantity" => ["nullable", "numeric", "bail",],
            "custom_product_type_id" => ["nullable", "numeric", "bail",
                Rule::exists("custom_product_types", "id")
                    ->where(function ($query) use ($row) {
                        $query->where([
                            'store_id' => $row['store_id']
                        ]);
                    })],
            "product_type_id" => ["nullable", "numeric", "bail", "exists:product_types,id"],
            "publish_product" => ["nullable", "boolean", "bail",],
            "date_available" => ["nullable", "string", "date_format:m-d-Y"],
            "seo_page_title" => ["nullable", "string", "bail"],
            "seo_description" => ["nullable", "string", "bail"],
            "sku" => ["string", "nullable", "bail", Rule::unique('product_variants')
                ->where(function ($query) use ($row) {
                    $query->where('store_id', $row['store_id']);
                })],
            "barcode" => ["string", "nullable", "bail",],
        ], [
            "exists" => "The :attribute entered does not exist."
        ], [
            "store_id" => "store",
            "brand_id" => "brand",
            "product_type_id" => "product type",
            "custom_product_type_id" => "custom product type",
        ]);
    }

    public function validateProductUpdate(Request $request)
    {
        $storeID = session()->get('store_id');
        $productID = $request->input('id');
        $validated = ValidatorWrapper::wrap($request, [
            "id" => ["required", "numeric", "bail",
                Rule::exists('products', 'id')
                    ->where(function ($query) use ($storeID) {
                        $query->where([
                            'store_id' => $storeID
                        ]);
                    })
            ],
            "title" => ["nullable", "string", "bail"],
            "description" => ["nullable", "string", "bail"],
            "weight" => ["numeric", "nullable", "bail"],
            "price" => ["numeric", "nullable", "bail",],
            "compare_at_price" => ["numeric", "nullable", "bail",],
            "handle" => ["string", "nullable", "bail",],
            "upc" => ["nullable", "string", "bail",],
            "ean" => ["nullable", "string", "bail",],
            "jan" => ["nullable", "string", "bail",],
            "isbn" => ["nullable", "string", "bail",],
            "mpn" => ["nullable", "string", "bail",],
            "location" => ["nullable", "string", "bail",],
            "tax_class" => ["nullable", "string", "bail"],
            "length" => ["nullable", "numeric", "bail",],
            "width" => ["nullable", "numeric", "bail",],
            "height" => ["nullable", "numeric", "bail",],
            "brand_id" => ["nullable", "numeric", "bail",
                Rule::exists('brands', 'id')
                    ->where(function ($query) use ($storeID) {
                        $query->where([
                            'store_id' => $storeID
                        ]);
                    })],
            "sort_attribute" => ["nullable", "numeric", "bail"],
            "has_variants" => ["boolean", "nullable", "bail",],
            "country_of_origin" => ["nullable", "string", "bail",],
            "step" => ["string", "nullable", "bail",],
            "sell_out_of_stock" => ["nullable", "boolean", "bail",],
            "quantity" => ["nullable", "numeric", "bail",],
            "custom_product_type_id" => ["nullable", "numeric", "bail",
                Rule::exists("custom_product_types", "id")
                    ->where(function ($query) use ($storeID) {
                        $query->where([
                            'store_id' => $storeID
                        ]);
                    })],
            "collections" => ["nullable", "array", "bail"],
            "collections.*" => ["numeric", "bail",
                Rule::exists('collections', 'id')
                    ->where(function ($query) use ($request) {
                        $query->where([
                            'store_id' => $request->input('store_id')
                        ]);
                    })],
            "product_type_id" => ["nullable", "numeric", "bail", "exists:product_types,id"],
            "publish_product" => ["nullable", "boolean", "bail",],
            "date_available" => ["nullable", "string", "date_format:m-d-Y"],
            "seo_page_title" => ["nullable", "string", "bail"],
            "seo_description" => ["nullable", "string", "bail"],
            "assets" => ['nullable',],
        ], [
            "exists" => "The :attribute entered does not exist."
        ], [
            "store_id" => "store",
            "brand_id" => "brand",
            "product_type_id" => "product type",
            "custom_product_type_id" => "custom product type",
        ])->toArray();
        if ($request->input('assets')) {
            ValidatorWrapper::wrap($request, [
                "assets.*.url" => ["string", "bail", "nullable"],
                "assets.*.thumb" => ["string", "bail", "nullable",],
                "assets.*.description" => ["string", "bail", "nullable"],
                "assets.*.rank" => ["numeric", "integer", "bail", "nullable"],
            ]);
        }
        if ($request->input('has_variants')) {
            $variantInputs = ValidatorWrapper::wrap($request, [
                "available_variant_attributes" => ["required", "bail"],
                "available_variant_attributes.*" => ["required", "string"],
                "variants.*.sku" => ["string", "required", "bail", Rule::unique('product_variants')
                    ->where(function ($query) use ($storeID, $productID) {
                        $query->where([
                            ['store_id', '=', $storeID],
                            ['product_id', '<>', $productID]
                        ]);
                    })],
                "variants.*.price" => ["numeric", "required", "bail",],
                "variants.*.quantity" => ["numeric", "required", "bail",],
                "variants.*.barcode" => ["string", "nullable", "bail",],
                "variants.*.attributes" => ["required",],
                "variants.*.attributes.*.attribute" => ["required", "string", "bail"],
                "variants.*.attributes.*.value" => ["required", "string", "bail"],
                "variants.*.assets" => ["nullable", "bail",],
                "variants.*.assets.*.url" => ["string", "bail", "required_with:variants.*.assets"],
                "variants.*.assets.*.thumb" => ["string", "bail", "nullable",],
                "variants.*.assets.*.description" => ["string", "bail", "nullable"],
                "variants.*.assets.*.rank" => ["numeric", "integer", "bail", "nullable"],
                // TODO: Properly define how images & assets would be handled
            ])->toArray();
            $skuHashTable = [];
            foreach ($request->input('variants') as $variant) {
                $uniqueHashTable = [];
                if (array_key_exists('assets', $variant)) {
                    foreach ($variant['assets'] as $asset) {
                        if (array_key_exists($asset['url'], $uniqueHashTable)) {
                            throw new InvalidInputException("Product variant images must be unique!");
                        }
                        $uniqueHashTable[$asset['url']] = true;
                    }
                }
                if (array_key_exists('sku', $variant)) {
                    if (array_key_exists('sku', $skuHashTable)) {
                        throw new InvalidInputException("The sku for each variant has to be unique");
                    }
                    $skuHashTable[$variant['sku']] = true;
                }
            }
            $validated = array_merge($validated, $variantInputs);
        } else {
            $extraInputs = ValidatorWrapper::wrap($request, [
                "sku" => ["string", "nullable", "bail", Rule::unique('product_variants')
                    ->where(function ($query) use ($request) {
                        $query->where('store_id', $request->input('store_id'));
                    })],
                "barcode" => ["string", "nullable", "bail",],
            ])->toArray();
            $validated = array_merge($validated, $extraInputs);
        }
        // Make sure asset urls are unique
        $uniqueHashTable = [];
        foreach ($request->input('assets') as $asset) {
            if (array_key_exists($asset['url'], $uniqueHashTable)) {
                throw new InvalidInputException("Product images must be unique!");
            }
            $uniqueHashTable[$asset['url']] = true;
        }
        return $validated;
    }

    public function validateUpdateProductStatusRequest(Request $request) {
        $validated = ValidatorWrapper::wrap($request, [
            "status" => ["required", "string", Rule::in("active", "archived", "deleted", "pending", "approved")],
        ]);

    }
}
