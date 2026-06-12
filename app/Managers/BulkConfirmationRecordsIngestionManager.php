<?php

namespace App\Managers;

use App\Managers\Contracts\BulkRecordsIngestionManagerInterface;
use Illuminate\Support\Collection;

class BulkConfirmationRecordsIngestionManager implements BulkRecordsIngestionManagerInterface
{

    public function validCallRecordsBulkInsert(Collection $records): void
    {
        // TODO: Implement validCallRecordsBulkInsert() method.
    }

    public function invalidCallRecordsBulkInsert(Collection $records): void
    {
        // TODO: Implement invalidCallRecordsBulkInsert() method.
    }
}
