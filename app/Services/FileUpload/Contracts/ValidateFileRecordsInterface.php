<?php

namespace App\Services\FileUpload\Contracts;

use App\Services\FileUpload\Enums\FileStrategyEnum;
use Illuminate\Support\Collection;

interface ValidateFileRecordsInterface
{
    public function validate(): void;

    public function setRecords(Collection $records): self;

    public function setStrategy(FileStrategyEnum $fileStrategy): self;
}
