<?php

namespace App\Services\FileUpload\Normalization;

use App\Services\FileUpload\Contracts\Normalization\NormalizationInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;

class NormalizationResolver
{
    public function resolve(FileStrategyEnum $fileStrategy): NormalizationInterface
    {
        return match ($fileStrategy) {
            FileStrategyEnum::CALL_RECORD_STORE => new CallChargeRecordNormalization(),
            FileStrategyEnum::CONFIRMATION_RECORD => new ConfirmationRecordNormalization(),
        };
    }
}
