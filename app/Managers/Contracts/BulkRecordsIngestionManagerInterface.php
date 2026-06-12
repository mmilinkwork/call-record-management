<?php

namespace App\Managers\Contracts;

use Illuminate\Support\Collection;

interface BulkRecordsIngestionManagerInterface
{
    public function validCallRecordsBulkInsert(Collection $records): void;

    public function invalidCallRecordsBulkInsert(Collection $records): void;
}
