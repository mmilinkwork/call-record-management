<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmationRecordsStoreRequest;
use App\Services\FileUpload\Contracts\ProcessFileInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;

class ConfirmationRecordController extends Controller
{
    public function __construct(protected ProcessFileInterface $processFileService)
    {
    }

    public function create()
    {
        return view('confirmation_records.upload');
    }

    public function store(ConfirmationRecordsStoreRequest $confirmationRecordsStoreRequest)
    {
        $this->processFileService
             ->setStrategy(FileStrategyEnum::CONFIRMATION_RECORD)
             ->setFile($confirmationRecordsStoreRequest->file('file'))
             ->dispatchProcessing();
    }
}
