<?php

namespace App\Services\FileUpload\Contracts;

interface RowValidationInterface
{
    public function validate(FileMappingInterface $record): ValidationResultInterface;
}
