<?php

namespace App\Services\FileUpload\Contracts\Normalization;

use App\Services\FileUpload\Contracts\FileMappingInterface;

interface NormalizationInterface
{
    public function adjustData(FileMappingInterface $singleRow): array;
}
