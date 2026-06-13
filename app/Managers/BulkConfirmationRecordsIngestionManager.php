<?php

namespace App\Managers;

use App\Managers\Contracts\BulkRecordsIngestionManagerInterface;
use App\Models\ConfirmationRecord;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class BulkConfirmationRecordsIngestionManager implements BulkRecordsIngestionManagerInterface
{
    /**
     * Store valid Confirmation Records in the database using bulk ingestion.
     *
     * @param Collection $records
     * @return void
     */
    public function validRecordsBulkInsert(Collection $records): void
    {
        try {
            ConfirmationRecord::insert($records->toArray());
        } catch (\Exception $exception)
        {
            //Depending on project complexity we can build service for logging and storing data for logs.
            //If we want some advance complexity we can use MongoDB for Logs as some kind of separation of concerns.
            Log::error('Bulk insert for valid call records fail. See details: ' . $exception->getMessage());
        }
    }

    /**
     * Store invalid confirmation records so we can track what happened.
     *
     * @param Collection $records
     * @return void
     */
    public function invalidRecordsBulkInsert(Collection $records): void
    {
        try {
            //waiting for model and migration
        } catch (\Exception $exception)
        {
            Log::error("Bulk insert for invalid call records fail. See details: " . $exception->getMessage());
        }
    }
}
