<?php

namespace App\Services\FileUpload\Mapping;

use App\Services\FileUpload\Contracts\FileMappingInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;

class FileMappingStrategyResolver
{
    public function resolve(FileStrategyEnum $fileStrategy, array $data): FileMappingInterface
    {
        return match ($fileStrategy) {
            FileStrategyEnum::CALL_RECORD_STORE => new CallRecordMapper($data),
            FileStrategyEnum::CONFIRMATION_RECORD => new ConfirmationRecordMapper($data)
        };
    }
}
