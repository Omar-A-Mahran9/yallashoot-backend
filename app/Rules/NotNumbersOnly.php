<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Closure;

class NotNumbersOnly implements Rule
{
 

 
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
        return __(":attribute ") . __('must be valid');
    }
}
 
