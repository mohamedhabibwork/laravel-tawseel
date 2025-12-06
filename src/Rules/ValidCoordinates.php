<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates coordinates format:
 * - Format: "latitude, longitude"
 * - Example: "24.7842, 46.6453"
 * - Must be comma-separated with space after comma
 */
final class ValidCoordinates implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail("The {$attribute} must be a string.");

            return;
        }

        $pattern = '/^-?\d+\.?\d*,\s*-?\d+\.?\d*$/';

        if (! preg_match($pattern, $value)) {
            $fail("The {$attribute} must be in format 'latitude, longitude' (e.g., '24.7842, 46.6453').");

            return;
        }

        [$lat, $lng] = array_map('trim', explode(',', $value));

        $latitude = (float) $lat;
        $longitude = (float) $lng;

        if ($latitude < -90 || $latitude > 90) {
            $fail("The {$attribute} latitude must be between -90 and 90.");

            return;
        }

        if ($longitude < -180 || $longitude > 180) {
            $fail("The {$attribute} longitude must be between -180 and 180.");
        }
    }
}
