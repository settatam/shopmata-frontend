<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OneWord implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $valueArray = explode(" ", $value);
        return count($valueArray) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must contain only one word.';
    }
}
