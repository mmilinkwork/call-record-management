<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CallChargeRecordsStore;
use App\Models\CallChargeRecord;
use App\Services\FileUpload\Contracts\ProcessChargeRecordInterface;
use Illuminate\Http\Request;

class CallChargeRecordController extends Controller
{
    public function __construct(private readonly ProcessChargeRecordInterface $processChargeRecordService)
    {
    }

    public function index()
    {
        $records = CallChargeRecord::paginate(20);

        return view('call_charge_records.index', compact('records'));
    }

    public function store(CallChargeRecordsStore $request)
    {
        $this->processChargeRecordService
            ->setFile($request->file('file'))
            ->dispatchProcessing();
    }

    public function show(CallChargeRecord $callRecord)
    {
        return view('call_charge_records.show', compact('callRecord'));
    }

    public function edit(CallChargeRecord $callRecord)
    {
        return view('call_charge_records.edit', compact('callRecord'));
    }

    public function update(Request $request, CallChargeRecord $callRecord)
    {
        $callRecord->update($request->only($callRecord->getFillable()));

        return redirect()->route('call-records.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(CallChargeRecord $callRecord)
    {
        $callRecord->delete();

        return redirect()->route('call-records.index')->with('success', 'Record deleted successfully.');
    }
}
