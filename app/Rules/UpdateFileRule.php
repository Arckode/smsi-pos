<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateFileRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_string($value)) {
            return;
        } else {
            $fileMimeType = $value->getClientMimeType();

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', "application/pdf"];

            if (in_array($fileMimeType, $allowedMimeTypes, true)) {
                return;
            } else {
                $fail('File type must be jpg, jpeg, png or pdf');
            }
        }
    }
}
