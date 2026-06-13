<?php

namespace App\Managers\Contracts;

use Illuminate\Support\Collection;

interface BulkRecordsIngestionManagerInterface
{
    public function validRecordsBulkInsert(Collection $records): void;

    public function invalidRecordsBulkInsert(Collection $records): void;
}
