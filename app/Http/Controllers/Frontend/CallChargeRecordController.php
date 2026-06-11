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
        $validated = $request->validate([
            'crce_operation'               => 'nullable|string|max:255',
            'charge_mode'                  => 'nullable|string|max:255',
            'sequence_total'               => 'nullable|integer',
            'imsi'                         => 'nullable|string|max:255',
            'calling_msisdn'               => 'nullable|string|max:255',
            'clip_suppress_number'         => 'nullable|boolean',
            'called_msisdn'                => 'nullable|string|max:255',
            'destination_network'          => 'nullable|string|max:255',
            'destination_zone'             => 'nullable|string|max:255',
            'traffic_type'                 => 'nullable|string|max:255',
            'apn'                          => 'nullable|string|max:255',
            'rating_group'                 => 'nullable|string|max:255',
            'message_type_indicator'       => 'nullable|string|max:255',
            'bearer_type'                  => 'nullable|string|max:255',
            'roaming'                      => 'nullable|boolean',
            'subscriber_location'          => 'nullable|string|max:255',
            'location_network'             => 'nullable|string|max:255',
            'location_zone'                => 'nullable|string|max:255',
            'answer_time'                  => 'nullable|date',
            'max_call_cost'                => 'nullable|numeric',
            'call_duration'                => 'nullable|integer',
            'ticket_call_duration'         => 'nullable|integer',
            'charged_duration'             => 'nullable|integer',
            'ticket_charged_duration'      => 'nullable|integer',
            'nr_of_segments'               => 'nullable|integer',
            'transferred_units'            => 'nullable|integer',
            'transferred_bytes'            => 'nullable|integer',
            'ticket_transferred_bytes'     => 'nullable|integer',
            'charged_bytes'                => 'nullable|integer',
            'ticket_charged_bytes'         => 'nullable|integer',
            'number_of_sms'                => 'nullable|integer',
            'ticket_number_of_sms'         => 'nullable|integer',
            'reference_number'             => 'nullable|string|max:255',
            'charge_free_action'           => 'nullable|boolean',
            'tariff'                       => 'nullable|string|max:255',
            'pool_id'                      => 'nullable|string|max:255',
            'account_descriptor_id'        => 'nullable|string|max:255',
            'account_reference_id'         => 'nullable|string|max:255',
            'account_difference'           => 'nullable|numeric',
            'charge_amount'                => 'nullable|numeric',
            'account_id'                   => 'nullable|string|max:255',
            'currency'                     => 'nullable|string|max:10',
            'closing_balance'              => 'nullable|numeric',
            'account_type'                 => 'nullable|string|max:255',
            'crce_result_code'             => 'nullable|string|max:255',
            'rating_filter_id'             => 'nullable|string|max:255',
            'revenue_code'                 => 'nullable|string|max:255',
            'transparent_data'             => 'nullable|string',
            'additional_rating_information'=> 'nullable|string',
        ]);

        $callRecord->update($validated);

        return redirect()->route('call-records.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(CallChargeRecord $callRecord)
    {
        $callRecord->delete();

        return redirect()->route('call-records.index')->with('success', 'Record deleted successfully.');
    }
}
