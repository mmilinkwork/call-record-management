<?php

namespace App\Services\FileUpload\Contracts;

use Illuminate\Http\UploadedFile;

interface ProcessChargeRecordInterface
{
    public function dispatchProcessing(): void;

    public function setFile(UploadedFile $uploadedFile): self;
}
