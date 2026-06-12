<?php

namespace App\Services\FileUpload\Contracts\Normalization;

use App\Services\FileUpload\Enums\FileStrategyEnum;
use Illuminate\Support\Collection;

interface DataNormalizationServiceInterface
{
    public function transform(): Collection;

    public function setRecords(Collection $records): self;

    public function setStrategy(FileStrategyEnum $fileStrategy): self;
}
