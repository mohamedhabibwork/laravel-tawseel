<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates Saudi ID number format:
 * - Must be 10 digits
 * - Must start with 1 (Saudi) or 2 (Non-Saudi/Resident)
 */
final class ValidIdNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) && ! is_numeric($value)) {
            $fail("The {$attribute} must be a valid ID number.");

            return;
        }

        $idNumber = (string) $value;

        if (strlen($idNumber) !== 10) {
            $fail("The {$attribute} must be exactly 10 digits.");

            return;
        }

        if (! ctype_digit($idNumber)) {
            $fail("The {$attribute} must contain only digits.");

            return;
        }

        if (! in_array($idNumber[0], ['1', '2'], true)) {
            $fail("The {$attribute} must start with 1 (Saudi) or 2 (Resident).");
        }
    }
}
