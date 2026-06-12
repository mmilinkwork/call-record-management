<?php

namespace App\Providers;

use App\Managers\BulkChargeRecordsIngestionManager;
use App\Managers\Contracts\BulkChargeRecordsIngestionManagerInterface;
use App\Services\FileUpload\Contracts\DataNormalizationServiceInterface;
use App\Services\FileUpload\Contracts\FileMappingInterface;
use App\Services\FileUpload\Contracts\ProcessFileInterface;
use App\Services\FileUpload\Contracts\SaveFileRecordsInterface;
use App\Services\FileUpload\Contracts\ValidateFileRecordsInterface;
use App\Services\FileUpload\DataNormalizationService;
use App\Services\FileUpload\Mapping\CallRecordMapper;
use App\Services\FileUpload\ProcessFileService;
use App\Services\FileUpload\SaveFileRecordsService;
use App\Services\FileUpload\ValidateFileRecordsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProcessFileInterface::class => ProcessFileService::class,
        SaveFileRecordsInterface::class => SaveFileRecordsService::class,
        ValidateFileRecordsInterface::class => ValidateFileRecordsService::class,
        DataNormalizationServiceInterface::class => DataNormalizationService::class,
        BulkChargeRecordsIngestionManagerInterface::class => BulkChargeRecordsIngestionManager::class,
        FileMappingInterface::class => CallRecordMapper::class,
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
