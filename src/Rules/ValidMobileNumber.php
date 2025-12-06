<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates driver mobile number format:
 * - Must be 10 digits
 * - Must start with 05
 */
final class ValidMobileNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail("The {$attribute} must be a valid mobile number.");

            return;
        }

        $mobile = (string) $value;

        if (strlen($mobile) !== 10) {
            $fail("The {$attribute} must be exactly 10 digits.");

            return;
        }

        if (! ctype_digit($mobile)) {
            $fail("The {$attribute} must contain only digits.");

            return;
        }

        if (! str_starts_with($mobile, '05')) {
            $fail("The {$attribute} must start with 05.");
        }
    }
}
