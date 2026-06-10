<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CallChargeRecordsStore;
use App\Services\FileUpload\Contracts\ProcessChargeRecordInterface;
use Illuminate\Http\Request;

class CallChargeRecordController extends Controller
{
    public function __construct(private readonly ProcessChargeRecordInterface $processChargeRecordService)
    {
    }

    public function index()
    {
        return view('call_charge_records.upload');
    }

    public function store(CallChargeRecordsStore $request)
    {
        $this->processChargeRecordService
            ->setFile($request->file('file'))
            ->dispatchProcessing();
    }
}
