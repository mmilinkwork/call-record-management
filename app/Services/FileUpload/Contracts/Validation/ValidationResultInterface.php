<?php

namespace App\Services\FileUpload\Contracts\Validation;

use Illuminate\Support\Collection;

interface ValidationResultInterface
{
    public function hasPassed(): bool;

    public function getErrors(): Collection;
}
