<?php

namespace App\Services\FileUpload\Contracts;

use Illuminate\Support\Collection;

interface SaveChargeRecordsInterface
{
    public function saveRecords();

    public function setRecords(Collection $records): self;
}
