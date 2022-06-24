<?php

namespace App\Rules;

use App\Helpers\FarsiHelper;
use Illuminate\Contracts\Validation\Rule;

class ValidMobile implements Rule
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
        return (FarsiHelper::isMobile($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.mobile');
    }
}
