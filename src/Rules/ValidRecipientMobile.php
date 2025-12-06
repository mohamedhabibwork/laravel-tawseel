<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates recipient mobile number format:
 * - Must be 12 characters
 * - Must start with 9665
 * - Format: 9665XXXXXXXX
 */
final class ValidRecipientMobile implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail("The {$attribute} must be a valid mobile number.");
            return;
        }

        $mobile = (string) $value;

        if (strlen($mobile) !== 12) {
            $fail("The {$attribute} must be exactly 12 characters.");
            return;
        }

        if (! ctype_digit($mobile)) {
            $fail("The {$attribute} must contain only digits.");
            return;
        }

        if (! str_starts_with($mobile, '9665')) {
            $fail("The {$attribute} must start with 9665.");
        }
    }
}
