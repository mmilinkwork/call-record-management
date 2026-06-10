<?php

namespace App\Services\FileUpload;

use App\Services\FileUpload\Contracts\SaveChargeRecordsInterface;
use App\Services\FileUpload\Contracts\ValidateChargeRecordsInterface;
use Illuminate\Support\Collection;

class SaveChargeRecordsService implements Contracts\SaveChargeRecordsInterface
{
    private Collection $records;

    public function __construct(private ValidateChargeRecordsInterface $validateChargeRecordsService)
    {
    }

    public function saveRecords()
    {
        $this->validateChargeRecordsService->setRecords($this->records)->validate();
    }

    public function setRecords(Collection $records): SaveChargeRecordsInterface
    {
        $this->records = $records;
        return $this;
    }
}
