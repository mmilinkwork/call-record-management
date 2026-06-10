<?php

namespace App\Services\FileUpload;

use App\Services\FileUpload\Contracts\DataNormalizationServiceInterface;
use App\Services\FileUpload\DataTransferObjects\SingleRowDTO;
use App\Services\FileUpload\Enums\TrafficTypeEnum;
use Illuminate\Support\Collection;

class DataNormalizationService implements Contracts\DataNormalizationServiceInterface
{
    private Collection $records;

    /**
     * We are transforming data for database insert.
     * We want to change some data using our business logic.
     *
     * @return Collection
     */
    public function transform(): Collection
    {
        $this->records->transform(function ($item) {
            return $this->normalizeData($item);
        });

        return collect($this->records);
    }

    /**
     * Using normalizeData method, we are changing structure of our data before insert into database.
     * Because we have some business rules we need to change some values in fields before inserting to database.
     * Example: For TrafficType=ShortMessage (SMS/MMS) duration is zero.
     * Documentation link: https://www.example.org/pscharfen-CRCECONF-ConfirmationRecord-280423-0734-135.pdf
     *
     * @param SingleRowDTO $singleRowDTO
     * @return array
     */
    private function normalizeData(SingleRowDTO $singleRowDTO): array
    {
        $data = $singleRowDTO->toArray();

        if($singleRowDTO->trafficType == TrafficTypeEnum::SHORT_MESSAGE->value)
        {
            $data['call_duration'] = 0;
            $data['ticket_call_duration'] = 0;
            $data['charged_duration'] = 0;
        }

        return $data;
    }

    /**
     * @param Collection $records
     * @return DataNormalizationServiceInterface
     */
    public function setRecords(Collection $records): DataNormalizationServiceInterface
    {
        $this->records = $records;
        return $this;
    }
}
