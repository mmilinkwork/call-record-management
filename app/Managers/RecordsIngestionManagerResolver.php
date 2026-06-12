<?php

namespace App\Managers;

use App\Managers\Contracts\BulkRecordsIngestionManagerInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;

class RecordsIngestionManagerResolver
{
    public function resolve(FileStrategyEnum $fileStrategy): BulkRecordsIngestionManagerInterface
    {
        return match ($fileStrategy) {
            FileStrategyEnum::CALL_RECORD_STORE => new BulkChargeRecordsIngestionManager(),
            FileStrategyEnum::CONFIRMATION_RECORD => new BulkConfirmationRecordsIngestionManager(),
        };
    }
}
