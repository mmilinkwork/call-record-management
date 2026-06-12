<?php

namespace App\Services\FileUpload\Normalization;

use App\Services\FileUpload\Contracts\FileMappingInterface;
use App\Services\FileUpload\Normalization\DataNormalization;

class ConfirmationRecordNormalization extends DataNormalization
{
    public function adjustData(FileMappingInterface $singleRow): array
    {
        return [];
    }
}
