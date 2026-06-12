<?php

namespace App\Services\FileUpload\Validations;

use App\Services\FileUpload\Contracts\Validation\ValidationResultInterface;
use Illuminate\Support\Collection;

readonly class ValidationResult implements ValidationResultInterface
{
    public function __construct(
        public bool       $passes,
        public Collection $errors
    ) {}

    /**
     * Check if validation passed.
     *
     * @return bool
     */
    public function hasPassed(): bool
    {
        return $this->passes;
    }

    /**
     * Get collection of errors if exists.
     *
     * @return Collection
     */
    public function getErrors(): Collection
    {
        return $this->errors;
    }
}
