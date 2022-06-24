<?php

namespace App\Rules;

use Morilog\Jalali\Jalalian;
use Illuminate\Contracts\Validation\Rule;

class ValidDate implements Rule
{
    protected $format = "";
    public function __construct($format = "Y-m-d")
    {
        $this->format = $format;
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
        $jDate = false;
        try {
            Jalalian::fromFormat($this->format, $value);
			return true;
        } catch (\Throwable $th) {
        }
		return $jDate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.date');
    }
}
