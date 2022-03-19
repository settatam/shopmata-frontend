<?php

namespace App\Validators\Product;

use App\Validators\ValidatorWrapper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

trait CollectionsControllerValidators
{
    public function validateCreateRequest(Request $request)
    {
        ValidatorWrapper::wrap($request, [
            'name' => ['string', 'required', 'bail'],
            'description' => ['string', 'nullable', 'bail'],
            'theme_id' => ['string', 'nullable', 'bail'],
            'conditions' => ['required', 'bail'],
            'conditions.*.attribute' => ['required', 'bail', Rule::in([
                'Product Title',
                'Product Type',
                'Product Vendor',
                'Product Price',
                'Product Tag',
                'Stock Quantity',
                'Weight',
            ])],
            'conditions.*.condition' => ['required', 'bail', Rule::in([
                'is equal to',
                'is not equal to',
                'is greater than',
                'is less than',
                'starts with',
                'ends with',
                'contains',
                'does not contain',
                'is not empty',
                'is empty',
            ])],
            'conditions.*.value' => ['required', 'bail', 'string'],
            'image_url' => ['string', 'nullable', 'bail'],
            'image_thumb' => ['string', 'nullable', 'bail'],
            'image_alt' => ['string', 'required_with:image_url', 'bail']
        ]);
    }

    public function validateUpdateRequest(Request $request)
    {
        ValidatorWrapper::wrap($request, [
            'name' => ['string', 'nullable', 'bail'],
            'description' => ['string', 'nullable', 'bail'],
            'theme_id' => ['string', 'nullable', 'bail'],
            'conditions' => ['nullable', 'bail'],
            'conditions.*.attribute' => ['required', 'bail', Rule::in([
                'Product Title',
                'Product Type',
                'Product Vendor',
                'Product Price',
                'Product Tag',
                'Stock Quantity',
                'Weight',
            ])],
            'conditions.*.condition' => ['required', 'bail', Rule::in([
                'is equal to',
                'is not equal to',
                'is greater than',
                'is less than',
                'starts with',
                'ends with',
                'contains',
                'does not contain',
                'is not empty',
                'is empty',
            ])],
            'conditions.*.value' => ['required_with:conditions', 'bail', 'string'],
            'image_url' => ['string', 'nullable', 'bail'],
            'image_thumb' => ['string', 'nullable', 'bail'],
            'image_alt' => ['string', 'required_with:image_url', 'bail']
        ]);
    }


}
