<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PostBodyRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $count = explode(' ', trim($value));
        $bodyLength = count($count);
        if ($bodyLength < 10 || $bodyLength > 1600) {
            $fail("Post must be at least 10 words and less than 1600 words");
        }
    }
}
