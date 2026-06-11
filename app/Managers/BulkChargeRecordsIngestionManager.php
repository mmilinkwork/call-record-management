<?php

namespace App\Managers;

use App\Managers\Contracts\BulkChargeRecordsIngestionManagerInterface;
use App\Models\CallChargeRecord;
use App\Models\CallChargeRecordInvalid;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class BulkChargeRecordsIngestionManager implements BulkChargeRecordsIngestionManagerInterface
{
    /**
     * Store valid Charge Records in the database using bulk ingestion.
     *
     * @param Collection $records
     * @return void
     */
    public function validCallRecordsBulkInsert(Collection $records): void
    {
        try {
            CallChargeRecord::upsert($records->toArray(), 'reference_number');
        } catch (\Exception $exception)
        {
            //Depending on project complexity we can build service for logging and storing data for logs.
            //If we want some advance complexity we can use MongoDB for Logs as some kind of separation of concerns.
            Log::error('Bulk insert for valid call records fail. See details: ' . $exception->getMessage());
        }
    }

    /**
     * Store invalid records so we can track what happened.
     *
     * @param Collection $records
     * @return void
     */
    public function invalidCallRecordsBulkInsert(Collection $records): void
    {
        try {
            CallChargeRecordInvalid::insert($records->toArray());
        } catch (\Exception $exception) {
            Log::error("Bulk insert for invalid call records fail. See details: " . $exception->getMessage());
        }
    }
}
