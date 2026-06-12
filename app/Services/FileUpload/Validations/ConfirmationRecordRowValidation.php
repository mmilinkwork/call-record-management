<?php

namespace App\Services\FileUpload\Validations;

use App\Services\FileUpload\Contracts\FileMappingInterface;
use App\Services\FileUpload\Contracts\Validation\ValidationResultInterface;

class ConfirmationRecordRowValidation extends RowValidation
{
    public function validate(FileMappingInterface $record): ValidationResultInterface
    {
        return new ValidationResult(true, collect([]));
    }
}
