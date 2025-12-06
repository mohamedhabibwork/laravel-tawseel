<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates date of birth format:
 * - Must be 8 digits
 * - Format: YYYYMMDD (e.g., 19900419)
 * - Accepts both Hijri and Gregorian calendars
 * - Note: Hijri dates preferred for Saudi drivers
 */
final class ValidDateOfBirth implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_numeric($value)) {
            $fail("The {$attribute} must be numeric.");
            return;
        }

        $dateOfBirth = (string) $value;

        if (strlen($dateOfBirth) !== 8) {
            $fail("The {$attribute} must be exactly 8 digits (YYYYMMDD format).");
            return;
        }

        if (! ctype_digit($dateOfBirth)) {
            $fail("The {$attribute} must contain only digits.");
            return;
        }

        $year = (int) substr($dateOfBirth, 0, 4);
        $month = (int) substr($dateOfBirth, 4, 2);
        $day = (int) substr($dateOfBirth, 6, 2);

        // Basic validation - check if month and day are reasonable
        if ($month < 1 || $month > 12) {
            $fail("The {$attribute} has an invalid month.");
            return;
        }

        if ($day < 1 || $day > 31) {
            $fail("The {$attribute} has an invalid day.");
        }
    }
}
