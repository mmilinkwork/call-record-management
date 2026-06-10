<?php

namespace App\Services\FileUpload;

use App\Jobs\SaveChargeRecordsJob;
use App\Services\FileUpload\Contracts\ProcessChargeRecordInterface;
use Illuminate\Http\UploadedFile;

class ProcessChargeRecordService implements Contracts\ProcessChargeRecordInterface
{
    private const BATCH_SIZE = 10;

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
                SaveChargeRecordsJob::dispatch($rows);

                $rows = collect(); // reset the collection for the next batch
            }
        }
    }

    /**
     * Set file.
     *
     * @param UploadedFile $uploadedFile
     * @return ProcessChargeRecordInterface
     */
    public function setFile(UploadedFile $uploadedFile): ProcessChargeRecordInterface
    {
        $this->file = $uploadedFile;
        return $this;
    }
}
