<?php

namespace App\Providers;

use App\Managers\BulkChargeRecordsIngestionManager;
use App\Managers\Contracts\BulkChargeRecordsIngestionManagerInterface;
use App\Services\FileUpload\Contracts\DataNormalizationServiceInterface;
use App\Services\FileUpload\Contracts\ProcessChargeRecordInterface;
use App\Services\FileUpload\Contracts\SaveChargeRecordsInterface;
use App\Services\FileUpload\Contracts\ValidateChargeRecordsInterface;
use App\Services\FileUpload\DataNormalizationService;
use App\Services\FileUpload\ProcessChargeRecordService;
use App\Services\FileUpload\SaveChargeRecordsService;
use App\Services\FileUpload\ValidateChargeRecordsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProcessChargeRecordInterface::class => ProcessChargeRecordService::class,
        SaveChargeRecordsInterface::class => SaveChargeRecordsService::class,
        ValidateChargeRecordsInterface::class => ValidateChargeRecordsService::class,
        DataNormalizationServiceInterface::class => DataNormalizationService::class,
        BulkChargeRecordsIngestionManagerInterface::class => BulkChargeRecordsIngestionManager::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
