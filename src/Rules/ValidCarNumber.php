<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates car number format:
 * - Must be 4 digits followed by 3 English letters
 * - Format: 1234ABC (left to right)
 * - Example: 1234ERS, 5678ABC
 */
final class ValidCarNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail("The {$attribute} must be a string.");

            return;
        }

        if (strlen($value) !== 7) {
            $fail("The {$attribute} must be exactly 7 characters (4 digits + 3 letters).");

            return;
        }

        $digits = substr($value, 0, 4);
        $letters = substr($value, 4, 3);

        if (! ctype_digit($digits)) {
            $fail("The {$attribute} must start with 4 digits.");

            return;
        }

        if (! ctype_alpha($letters) || ! ctype_upper($letters)) {
            $fail("The {$attribute} must end with 3 uppercase English letters.");
        }
    }
}
