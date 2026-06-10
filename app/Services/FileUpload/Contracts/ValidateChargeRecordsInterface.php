<?php

namespace App\Services\FileUpload\Contracts;

use Illuminate\Support\Collection;

interface ValidateChargeRecordsInterface
{
    public function validate(): void;

    public function setRecords(Collection $records): self;
}
