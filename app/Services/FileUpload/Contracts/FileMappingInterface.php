<?php

namespace App\Services\FileUpload\Contracts;

interface FileMappingInterface
{
    public function __construct(array $record);

    public function toArray(): array;

    public function toJson(): string;
}
