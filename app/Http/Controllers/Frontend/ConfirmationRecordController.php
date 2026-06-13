<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmationRecordsStoreRequest;
use App\Models\ConfirmationRecord;
use App\Services\FileUpload\Contracts\ProcessFileInterface;
use App\Services\FileUpload\Enums\FileStrategyEnum;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ConfirmationRecordController extends Controller
{
    public function __construct(protected ProcessFileInterface $processFileService)
    {
    }

    public function index(Request $request)
    {
        $records = $this->applyFilters(ConfirmationRecord::query(), $request)
            ->paginate(20)
            ->withQueryString();

        return view('confirmation_records.index', [
            'records' => $records,
            'filters' => $request->only(['subscriber_imsi', 'crce_operation', 'service_type']),
        ]);
    }

    public function exportPdf(Request $request)
    {
        $records = $this->applyFilters(ConfirmationRecord::query(), $request)->get();
        $filters = $request->only(['subscriber_imsi', 'crce_operation', 'service_type']);

        $pdf = Pdf::loadView('confirmation_records.pdf', compact('records', 'filters'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('confirmation-records.pdf');
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

        return redirect()->route('confirmation-records.index')->with('success', 'File uploaded and is being processed.');
    }

    public function show(ConfirmationRecord $confirmationRecord)
    {
        return view('confirmation_records.show', compact('confirmationRecord'));
    }

    public function edit(ConfirmationRecord $confirmationRecord)
    {
        return view('confirmation_records.edit', compact('confirmationRecord'));
    }

    public function update(Request $request, ConfirmationRecord $confirmationRecord)
    {
        $validated = $request->validate([
            'crce_operation'    => 'nullable|string|max:255',
            'active_feature'    => 'nullable|string|max:255',
            'sequence_total'    => 'nullable|integer',
            'bundle_code'       => 'nullable|string|max:255',
            'oppId'             => 'nullable|integer',
            'service_type'      => 'nullable|string|max:255',
            'customer_care_user'=> 'nullable|string|max:255',
            'subscriber_language' => 'nullable|string|max:255',
            'subscriber_imsi'   => 'nullable|string|max:255',
        ]);

        $confirmationRecord->update($validated);

        return redirect()->route('confirmation-records.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(ConfirmationRecord $confirmationRecord)
    {
        $confirmationRecord->delete();

        return redirect()->route('confirmation-records.index')->with('success', 'Record deleted successfully.');
    }

    private function applyFilters(\Illuminate\Database\Eloquent\Builder $query, Request $request): \Illuminate\Database\Eloquent\Builder
    {
        if ($request->filled('subscriber_imsi')) {
            $safe = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $request->input('subscriber_imsi'));
            $query->where('subscriber_imsi', 'like', '%' . $safe . '%');
        }

        if ($request->filled('crce_operation')) {
            $safe = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $request->input('crce_operation'));
            $query->where('crce_operation', 'like', '%' . $safe . '%');
        }

        if ($request->filled('service_type')) {
            $query->where('service_type', $request->input('service_type'));
        }

        return $query;
    }
}
