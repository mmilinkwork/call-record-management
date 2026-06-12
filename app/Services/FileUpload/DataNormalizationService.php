<?php

namespace App\Services\FileUpload;

use App\Services\FileUpload\Contracts\Normalization\DataNormalizationServiceInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;
use App\Services\FileUpload\Normalization\NormalizationResolver;
use Illuminate\Support\Collection;

class DataNormalizationService implements Contracts\Normalization\DataNormalizationServiceInterface
{
    private Collection $records;
    private FileStrategyEnum $fileStrategy;
    private NormalizationResolver $normalizationResolver;

    public function __construct()
    {
        $this->normalizationResolver = new NormalizationResolver();
    }

    /**
     * We are transforming data for database insert.
     * We want to change some data using our business logic.
     *
     * @return Collection
     */
    public function transform(): Collection
    {
        $this->records->transform(function ($singleRow) {
            return $this->normalizationResolver->resolve($this->fileStrategy)->adjustData($singleRow);
        });

        return collect($this->records);
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

    /**
     * @param FileStrategyEnum $fileStrategy
     * @return DataNormalizationServiceInterface
     */
    public function setStrategy(FileStrategyEnum $fileStrategy): DataNormalizationServiceInterface
    {
        $this->fileStrategy = $fileStrategy;
        return $this;
    }
}
