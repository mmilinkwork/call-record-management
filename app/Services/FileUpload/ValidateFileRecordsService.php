<?php

namespace App\Services\FileUpload;

use App\Services\FileUpload\Contracts\Validation\ValidateFileRecordsInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;
use App\Services\FileUpload\Mapping\FileMappingStrategyResolver;
use App\Services\FileUpload\Validations\RowValidationStrategyResolver;
use Illuminate\Support\Collection;

class ValidateFileRecordsService implements Contracts\Validation\ValidateFileRecordsInterface
{
    private FileStrategyEnum $fileStrategy;

    private Collection $records;

    private Collection $validRecords;
    private Collection $invalidRecords;
    private FileMappingStrategyResolver $fileMappingStrategyResolver;
    private RowValidationStrategyResolver $rowValidationStrategyResolver;

    public function __construct()
    {
        $this->validRecords = collect();
        $this->invalidRecords = collect();
        $this->rowValidationStrategyResolver = new RowValidationStrategyResolver();
        $this->fileMappingStrategyResolver = new FileMappingStrategyResolver();
    }

    /**
     * We need to validate every row before inserting it to database.
     * Every field has specific rules. So we need to pass through all rows and pass through all fields.
     * So, cuz of that, we will separate valid and invalid records. And insert into database table only valid records.
     * Invalid records will be inserted in different table so we can debug what happens with those rows.
     *
     * @return void
     */
    public function validate(): void
    {
        foreach ($this->records as $record)
        {
            try
            {
                $mappedRow = $this->fileMappingStrategyResolver
                                  ->resolve($this->fileStrategy, $this->parseSingleRow($record));

                $validationResult = $this->rowValidationStrategyResolver
                                             ->resolve($this->fileStrategy)
                                             ->validate($mappedRow);

                if ($validationResult->hasPassed())
                {
                    $this->validRecords->push($mappedRow);
                } else
                {
                    $invalidRow = (object) [
                        'record' => $mappedRow->toJson(),
                        'errors' => $validationResult->errors
                    ];

                    $this->invalidRecords->push($invalidRow);
                }

            }catch (\Exception $exception)
            {
                $this->invalidRecords->push([
                    'record' => $record,
                    'message' => $exception->getMessage()
                ]);
            }
        }
    }

    /**
     * Parse a single row of the charge record file and return an array of values.
     * We are returning array starting from 1 not from 0. If you take a look into documentation
     * you can see that header fiealds starts from 1 to 23, so they don't use 0 as index.
     * Documentation link: https://www.example.org/pscharfen-CRCECONF-ConfirmationRecord-280423-0734-135.pdf
     *
     *
     * @param string $record
     * @return array
     */
    private function parseSingleRow(string $record): array
    {
        $record = explode('|', $record);

        $values = array_combine(
            range(1, count($record)),
            $record
        );

        return $values;
    }

    /**
     * Set collection of rows.
     *
     * @param Collection $records
     * @return ValidateFileRecordsInterface
     */
    public function setRecords(Collection $records): ValidateFileRecordsInterface
    {
        $this->records = $records;
        return $this;
    }

    /**
     * @param FileStrategyEnum $fileStrategy
     * @return ValidateFileRecordsInterface
     */
    public function setStrategy(FileStrategyEnum $fileStrategy): ValidateFileRecordsInterface
    {
        $this->fileStrategy = $fileStrategy;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getValidRecords(): Collection
    {
        return $this->validRecords;
    }

    /**
     * @return Collection
     */
    public function getInvalidRecords(): Collection
    {
        return $this->invalidRecords;
    }
}
