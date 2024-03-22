<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordValidate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !preg_match('/^\d+$/', $value);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __(":attribute ") . __('must contain character and numbers');

        // return 'The validation error message.';
    }
}
