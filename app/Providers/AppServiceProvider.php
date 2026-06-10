<?php

namespace App\Providers;

use App\Services\FileUpload\Contracts\ProcessChargeRecordInterface;
use App\Services\FileUpload\Contracts\SaveChargeRecordsInterface;
use App\Services\FileUpload\Contracts\ValidateChargeRecordsInterface;
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
