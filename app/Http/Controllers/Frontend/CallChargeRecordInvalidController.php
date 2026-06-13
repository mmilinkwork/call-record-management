<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CallChargeRecordInvalid;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CallChargeRecordInvalidController extends Controller
{
    public function index(Request $request)
    {
        $records = $this->applyFilters(CallChargeRecordInvalid::query(), $request)
            ->paginate(20)
            ->withQueryString();

        return view('call_charge_record_invalids.index', [
            'records' => $records,
            'filters' => $request->only(['record', 'message']),
        ]);
    }

    public function exportPdf(Request $request)
    {
        $records = $this->applyFilters(CallChargeRecordInvalid::query(), $request)->get();
        $filters = $request->only(['record', 'message']);

        $pdf = Pdf::loadView('call_charge_record_invalids.pdf', compact('records', 'filters'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('call-charge-record-invalids.pdf');
    }

    public function create()
    {
        return view('call_charge_record_invalids.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'record'  => 'required|string',
            'message' => 'nullable|string',
        ]);

        CallChargeRecordInvalid::create($validated);

        return redirect()->route('call-charge-record-invalids.index')->with('success', 'Record created successfully.');
    }

    public function show(CallChargeRecordInvalid $callChargeRecordInvalid)
    {
        return view('call_charge_record_invalids.show', compact('callChargeRecordInvalid'));
    }

    public function edit(CallChargeRecordInvalid $callChargeRecordInvalid)
    {
        return view('call_charge_record_invalids.edit', compact('callChargeRecordInvalid'));
    }

    public function update(Request $request, CallChargeRecordInvalid $callChargeRecordInvalid)
    {
        $validated = $request->validate([
            'record'  => 'required|string',
            'message' => 'nullable|string',
        ]);

        $callChargeRecordInvalid->update($validated);

        return redirect()->route('call-charge-record-invalids.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(CallChargeRecordInvalid $callChargeRecordInvalid)
    {
        $callChargeRecordInvalid->delete();

        return redirect()->route('call-charge-record-invalids.index')->with('success', 'Record deleted successfully.');
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
