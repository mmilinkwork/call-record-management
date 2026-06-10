<?php

namespace App\Jobs;

use App\Services\FileUpload\Contracts\SaveChargeRecordsInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class SaveChargeRecordsJob implements ShouldQueue
{
    use Queueable;

    private SaveChargeRecordsInterface $saveChargeRecordsService;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Collection $chargeRecords)
    {
        $this->saveChargeRecordsService = app(SaveChargeRecordsInterface::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->saveChargeRecordsService->setRecords($this->chargeRecords)->saveRecords();
    }
}
