<?php

namespace App\Services\FileUpload\Normalization;

use App\Services\FileUpload\Contracts\FileMappingInterface;
use App\Services\FileUpload\Enums\TrafficTypeEnum;

class CallChargeRecordNormalization extends DataNormalization
{
    /**
     * Using normalizeData method, we are changing structure of our data before insert into database.
     * Because we have some business rules we need to change some values in fields before inserting to database.
     * Example: For TrafficType=ShortMessage (SMS/MMS) duration is zero.
     * Documentation link: https://www.example.org/pscharfen-CRCECONF-ConfirmationRecord-280423-0734-135.pdf
     *
     * @param FileMappingInterface $singleRow
     * @return array
     */
    public function adjustData(FileMappingInterface $singleRow): array
    {
        $data = $singleRow->toArray();

        if($singleRow->trafficType == TrafficTypeEnum::SHORT_MESSAGE->value)
        {
            $data['call_duration'] = 0;
            $data['ticket_call_duration'] = 0;
            $data['charged_duration'] = 0;
        }

        return $data;
    }
}
