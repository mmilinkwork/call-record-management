<?php

namespace App\Services\FileUpload\Validations;

use App\Services\FileUpload\Contracts\RowValidationInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;

class RowValidationStrategyResolver
{
    public function resolve(FileStrategyEnum $fileStrategy): RowValidationInterface
    {
        return match ($fileStrategy) {
            FileStrategyEnum::CALL_RECORD_STORE => new CallChargeRecordRowValidation(),
            FileStrategyEnum::CONFIRMATION_RECORD => new ConfirmationRecordRowValidation()
        };
    }
}
