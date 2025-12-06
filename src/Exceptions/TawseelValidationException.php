<?php

declare(strict_types=1);

namespace Habib\LaravelTawseel\Exceptions;

use Illuminate\Contracts\Validation\Validator;

final class TawseelValidationException extends TawseelException
{
    public function __construct(
        private readonly Validator $validator
    ) {
        parent::__construct('Validation failed: '.implode(', ', $this->validator->errors()->all()));
    }

    public function getValidator(): Validator
    {
        return $this->validator;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function getErrors(): array
    {
        return $this->validator->errors()->toArray();
    }
}
