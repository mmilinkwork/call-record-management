<?php

namespace App\Services\FileUpload\Contracts;

use App\Services\FileUpload\Enums\FileStrategyEnum;
use Illuminate\Http\UploadedFile;

interface ProcessFileInterface
{
    public function dispatchProcessing(): void;

    public function setFile(UploadedFile $uploadedFile): self;

    public function setStrategy(FileStrategyEnum $strategy): self;
}
