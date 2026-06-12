<?php

namespace App\Services\FileUpload;

use App\Jobs\SaveFileRecordsJob;
use App\Services\FileUpload\Contracts\ProcessFileInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;
use Illuminate\Http\UploadedFile;

class ProcessFileService implements Contracts\ProcessFileInterface
{
    private const BATCH_SIZE = 10;

    protected FileStrategyEnum $fileStrategy;
    protected UploadedFile $file;

    /**
     * Dispatch rows in chunk. We are reading file that user tries to upload and chunk rows in batch and pass to job.
     *
     * @return void
     */
    public function dispatchProcessing(): void
    {
        $rows = collect();
        foreach(file($this->file) as $line)
        {
            $rows->push($line);

            if ($rows->count() == self::BATCH_SIZE)
            {
                // dispatch a job to process the current batch of lines
                SaveFileRecordsJob::dispatch($rows, $this->fileStrategy);

                $rows = collect(); // reset the collection for the next batch
            }
        }
    }

    /**
     * Set file.
     *
     * @param UploadedFile $uploadedFile
     * @return ProcessFileInterface
     */
    public function setFile(UploadedFile $uploadedFile): ProcessFileInterface
    {
        $this->file = $uploadedFile;
        return $this;
    }

    /**
     * Set strategy for given file.
     *
     * @param FileStrategyEnum $strategy
     * @return ProcessFileInterface
     */
    public function setStrategy(FileStrategyEnum $strategy): ProcessFileInterface
    {
        $this->fileStrategy = $strategy;
        return $this;
    }
}
