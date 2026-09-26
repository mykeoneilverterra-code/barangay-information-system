<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhilippineMobileNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Nullable Field
        |--------------------------------------------------------------------------
        |
        | Empty values are allowed because contact_number
        | is nullable in our Form Request.
        |
        */

        if (
            $value === null
            || $value === ''
        ) {

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Philippine Mobile Number Format
        |--------------------------------------------------------------------------
        |
        | Required final normalized format:
        |
        | 09XXXXXXXXX
        |
        | Example:
        |
        | 09165807893
        |
        */

        if (
            !preg_match(
                '/^09\d{9}$/',
                (string) $value
            )
        ) {

            $fail(
                'The :attribute must be a valid Philippine mobile number starting with 09 and containing exactly 11 digits.'
            );
        }
    }
}