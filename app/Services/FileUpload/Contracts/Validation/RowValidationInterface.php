<?php

namespace App\Services\FileUpload\Contracts\Validation;

use App\Services\FileUpload\Contracts\FileMappingInterface;

interface RowValidationInterface
{
    public function validate(FileMappingInterface $record): ValidationResultInterface;
}
