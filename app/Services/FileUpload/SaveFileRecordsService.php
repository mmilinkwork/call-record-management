<?php

namespace App\Services\FileUpload;

use App\Managers\Contracts\BulkRecordsIngestionManagerInterface;
use App\Managers\RecordsIngestionManagerResolver;
use App\Services\FileUpload\Contracts\Normalization\DataNormalizationServiceInterface;
use App\Services\FileUpload\Contracts\SaveFileRecordsInterface;
use App\Services\FileUpload\Contracts\Validation\ValidateFileRecordsInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;
use Illuminate\Support\Collection;

class SaveFileRecordsService implements Contracts\SaveFileRecordsInterface
{
    private FileStrategyEnum $fileStrategy;
    private Collection $records;

    public function __construct(
        private readonly ValidateFileRecordsInterface      $validateChargeRecordsService,
        private readonly DataNormalizationServiceInterface $dataNormalizationService,
        private readonly RecordsIngestionManagerResolver $recordsIngestionManagerResolver
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
    public function saveRecords(): void
    {
        $this->validateChargeRecordsService
             ->setStrategy($this->fileStrategy)
             ->setRecords($this->records)
             ->validate();

        $validData = $this->dataNormalizationService
                          ->setStrategy($this->fileStrategy)
                          ->setRecords($this->validateChargeRecordsService->getValidRecords())
                          ->transform();

        $ingestionManager = $this->recordsIngestionManagerResolver->resolve($this->fileStrategy);

        $ingestionManager->validRecordsBulkInsert($validData);
        $ingestionManager->invalidRecordsBulkInsert($this->validateChargeRecordsService->getInvalidRecords());
    }

    /**
     * @param Collection $records
     * @return SaveFileRecordsInterface
     */
    public function setRecords(Collection $records): SaveFileRecordsInterface
    {
        $this->records = $records;
        return $this;
    }

    /**
     * @param FileStrategyEnum $fileStrategy
     * @return SaveFileRecordsInterface
     */
    public function setStrategy(FileStrategyEnum $fileStrategy): SaveFileRecordsInterface
    {
        $this->fileStrategy = $fileStrategy;
        return $this;
    }
}
