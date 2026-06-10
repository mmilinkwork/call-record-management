<?php

namespace App\Services\FileUpload;

use App\Services\FileUpload\Contracts\ValidateChargeRecordsInterface;
use App\Services\FileUpload\Validations\SingleRowValidator;
use App\Services\FileUpload\Validations\ValidationResult;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ValidateChargeRecordsService implements Contracts\ValidateChargeRecordsInterface
{
    private const EXPECTED_NUMBER_OF_FIELDS = 73;

    private Collection $records;

    private Collection $validRecords;
    private Collection $invalidRecords;
    private SingleRowValidator $singleRowValidator;

    public function __construct()
    {
        $this->validRecords = collect();
        $this->invalidRecords = collect();
        $this->singleRowValidator = new SingleRowValidator();
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
            if ($this->hasEnoughFields(explode('|', $record)))
            {
                try {
                    $singleRowDTO = new DataTransferObjects\SingleRowDTO($this->parseSingleRow($record));

                    $validationResult = $this->singleRowValidator->validate($singleRowDTO);

                    if ($validationResult->passes)
                    {
                        $this->validRecords->push($singleRowDTO);
                    } else
                    {
                        $invalidRow = (object) [
                            'record' => $singleRowDTO->toJson(),
                            'errors' => $validationResult->errors
                        ];

                        $this->invalidRecords->push($invalidRow);
                    }

                }catch (\Exception $exception) {
                    $this->invalidRecords->push([
                        'record' => $record,
                        'message' => $exception->getMessage()
                    ]);
                }
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
     * We are expecting exactly 73 fields in each row of the charge record file.
     * If there are more or less fields, we will consider that row as invalid and we will skip it.
     * Documentation link: https://www.example.org/pscharfen-CRCECONF-ConfirmationRecord-280423-0734-135.pdf
     *
     * @param array $record
     * @return bool
     */
    private function hasEnoughFields(array $record): bool
    {
        return count($record) == self::EXPECTED_NUMBER_OF_FIELDS;
    }

    /**
     * Set collection of rows.
     *
     * @param Collection $records
     * @return ValidateChargeRecordsInterface
     */
    public function setRecords(Collection $records): ValidateChargeRecordsInterface
    {
        $this->records = $records;
        return $this;
    }

    public function getValidRecords(): Collection
    {
        return $this->validRecords;
    }

    public function getInvalidRecords(): Collection
    {
        return $this->invalidRecords;
    }
}
