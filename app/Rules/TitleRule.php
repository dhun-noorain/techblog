<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TitleRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $count = explode(' ', trim($value));
        $titleLength = count($count);
        if ($titleLength < 1 || $titleLength > 60) {
            $fail("Title must be at least one word and less than 60 words");
        }
    }
}
