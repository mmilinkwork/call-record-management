<?php

namespace App\Jobs;

use App\Services\FileUpload\Contracts\SaveFileRecordsInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class SaveFileRecordsJob implements ShouldQueue
{
    use Queueable;

    private SaveFileRecordsInterface $saveFileRecordsService;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Collection $chargeRecords,
        private readonly FileStrategyEnum $fileStrategy
    )
    {
        $this->saveFileRecordsService = app(SaveFileRecordsInterface::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->saveFileRecordsService
             ->setRecords($this->chargeRecords)
             ->setStrategy($this->fileStrategy)
             ->saveRecords();
    }
}
