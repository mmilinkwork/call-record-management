<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ConfirmationRecordInvalid;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ConfirmationRecordInvalidController extends Controller
{
    public function index(Request $request)
    {
        $records = $this->applyFilters(ConfirmationRecordInvalid::query(), $request)
            ->paginate(20)
            ->withQueryString();

        return view('confirmation_record_invalids.index', [
            'records' => $records,
            'filters' => $request->only(['record', 'message']),
        ]);
    }

    public function exportPdf(Request $request)
    {
        $records = $this->applyFilters(ConfirmationRecordInvalid::query(), $request)->get();
        $filters = $request->only(['record', 'message']);

        $pdf = Pdf::loadView('confirmation_record_invalids.pdf', compact('records', 'filters'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('confirmation-record-invalids.pdf');
    }

    public function create()
    {
        return view('confirmation_record_invalids.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'record'  => 'required|string',
            'message' => 'nullable|string',
        ]);

        ConfirmationRecordInvalid::create($validated);

        return redirect()->route('confirmation-record-invalids.index')->with('success', 'Record created successfully.');
    }

    public function show(ConfirmationRecordInvalid $confirmationRecordInvalid)
    {
        return view('confirmation_record_invalids.show', compact('confirmationRecordInvalid'));
    }

    public function edit(ConfirmationRecordInvalid $confirmationRecordInvalid)
    {
        return view('confirmation_record_invalids.edit', compact('confirmationRecordInvalid'));
    }

    public function update(Request $request, ConfirmationRecordInvalid $confirmationRecordInvalid)
    {
        $validated = $request->validate([
            'record'  => 'required|string',
            'message' => 'nullable|string',
        ]);

        $confirmationRecordInvalid->update($validated);

        return redirect()->route('confirmation-record-invalids.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(ConfirmationRecordInvalid $confirmationRecordInvalid)
    {
        $confirmationRecordInvalid->delete();

        return redirect()->route('confirmation-record-invalids.index')->with('success', 'Record deleted successfully.');
    }

    private function applyFilters(\Illuminate\Database\Eloquent\Builder $query, Request $request): \Illuminate\Database\Eloquent\Builder
    {
        if ($request->filled('record')) {
            $safe = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $request->input('record'));
            $query->where('record', 'like', '%' . $safe . '%');
        }

        if ($request->filled('message')) {
            $safe = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $request->input('message'));
            $query->where('message', 'like', '%' . $safe . '%');
        }

        return $query;
    }
}
