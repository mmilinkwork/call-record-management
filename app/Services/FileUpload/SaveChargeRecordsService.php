<?php

namespace App\Services\FileUpload;

use App\Managers\Contracts\BulkChargeRecordsIngestionManagerInterface;
use App\Services\FileUpload\Contracts\DataNormalizationServiceInterface;
use App\Services\FileUpload\Contracts\SaveChargeRecordsInterface;
use App\Services\FileUpload\Contracts\ValidateChargeRecordsInterface;
use Illuminate\Support\Collection;

class SaveChargeRecordsService implements Contracts\SaveChargeRecordsInterface
{
    private Collection $records;

    public function __construct(
        private ValidateChargeRecordsInterface $validateChargeRecordsService,
        private DataNormalizationServiceInterface $dataNormalizationService,
        private BulkChargeRecordsIngestionManagerInterface $bulkChargeRecordsIngestionManager
    )
    {
    }

    /**
     * Save records to database.
     *
     * 1. We validate all rows to understand is there any row that satisfies our requirements.
     * 2. Then, we "Normalize data" we know that for some cases, we need to change row data before database insert.
     * Example: For TrafficType=ShortMessage (SMS/MMS) duration is zero.
     * 3. Then we call ChargeRecordsManager for bulk insert into database. We insert two types of data: valid and invalid.
     *
     * @return void
     */
    public function saveRecords()
    {
        $this->validateChargeRecordsService->setRecords($this->records)->validate();

        $validData = $this->dataNormalizationService
                     ->setRecords($this->validateChargeRecordsService->getValidRecords())
                     ->transform();

        $this->bulkChargeRecordsIngestionManager->validCallRecordsBulkInsert($validData);
        $this->bulkChargeRecordsIngestionManager->invalidCallRecordsBulkInsert($this->validateChargeRecordsService->getInvalidRecords());
    }

    /**
     * @param Collection $records
     * @return SaveChargeRecordsInterface
     */
    public function setRecords(Collection $records): SaveChargeRecordsInterface
    {
        $this->records = $records;
        return $this;
    }
}
