<?php

namespace App\Validators;

use App\Exceptions\InvalidInputException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ValidatedInput;

class ValidatorWrapper
{
    /**
     * @throws InvalidInputException
     */
    public static function wrap(Request $request, array $rules, array $messages = [], array $attributes = []): ValidatedInput
    {
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            throw new InvalidInputException($validator->errors()->first());
        }
        return $validator->safe();
    }
}
