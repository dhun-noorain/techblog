<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BioRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $count = array_filter(explode(' ', trim($value)));
        $bioLength = count($count);
        if ($bioLength > 50) {
            $fail("Bio must not be greater than 50 words");
        }
    }
}
