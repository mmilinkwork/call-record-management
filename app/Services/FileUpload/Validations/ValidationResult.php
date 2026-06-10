<?php

namespace App\Services\FileUpload\Validations;

use Illuminate\Support\Collection;

class ValidationResult
{
    public function __construct(
        public readonly bool $passes,
        public readonly Collection $errors
    ) {}
}
