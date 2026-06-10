<?php

namespace App\Services\FileUpload\Contracts;

use Illuminate\Support\Collection;

interface DataNormalizationServiceInterface
{
    public function transform(): Collection;

    public function setRecords(Collection $records): self;
}
