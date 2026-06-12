<?php

namespace App\Services\FileUpload\Contracts;

use Illuminate\Support\Collection;

interface ValidationResultInterface
{
    public function hasPassed(): bool;

    public function getErrors(): Collection;
}
