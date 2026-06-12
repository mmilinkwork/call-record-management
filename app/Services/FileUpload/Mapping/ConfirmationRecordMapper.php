<?php

namespace App\Services\FileUpload\Mapping;

use App\Services\FileUpload\Mapping\FileMapper;

class ConfirmationRecordMapper extends FileMapper
{
    public function __construct(array $record)
    {
    }

    public function toArray(): array
    {
        return [];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
