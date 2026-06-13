@extends('layouts.app')

@section('title', 'Edit Call Charge Record #' . $callRecord->id)

@section('container-class', 'container')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Record <span class="text-muted fs-5">#{{ $callRecord->id }}</span></h2>
        <a href="{{ route('call-records.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('call-records.update', $callRecord) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- crce_operation -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CRCE Operation</label>
                        <input type="text" name="crce_operation" class="form-control @error('crce_operation') is-invalid @enderror"
                               value="{{ old('crce_operation', $callRecord->crce_operation) }}">
                        @error('crce_operation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- charge_mode -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Charge Mode</label>
                        <input type="text" name="charge_mode" class="form-control @error('charge_mode') is-invalid @enderror"
                               value="{{ old('charge_mode', $callRecord->charge_mode) }}">
                        @error('charge_mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- sequence_total -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sequence Total</label>
                        <input type="number" name="sequence_total" class="form-control @error('sequence_total') is-invalid @enderror"
                               value="{{ old('sequence_total', $callRecord->sequence_total) }}">
                        @error('sequence_total')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- imsi -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">IMSI</label>
                        <input type="text" name="imsi" class="form-control @error('imsi') is-invalid @enderror"
                               value="{{ old('imsi', $callRecord->imsi) }}">
                        @error('imsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- calling_msisdn -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Calling MSISDN</label>
                        <input type="text" name="calling_msisdn" class="form-control @error('calling_msisdn') is-invalid @enderror"
                               value="{{ old('calling_msisdn', $callRecord->calling_msisdn) }}">
                        @error('calling_msisdn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- clip_suppress_number -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CLIP Suppress Number</label>
                        <select name="clip_suppress_number" class="form-select @error('clip_suppress_number') is-invalid @enderror">
                            <option value="">— Select —</option>
                            <option value="1" {{ old('clip_suppress_number', $callRecord->clip_suppress_number) == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('clip_suppress_number', $callRecord->clip_suppress_number) == '0' && old('clip_suppress_number', $callRecord->clip_suppress_number) !== null && old('clip_suppress_number', $callRecord->clip_suppress_number) !== '' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('clip_suppress_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- called_msisdn -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Called MSISDN</label>
                        <input type="text" name="called_msisdn" class="form-control @error('called_msisdn') is-invalid @enderror"
                               value="{{ old('called_msisdn', $callRecord->called_msisdn) }}">
                        @error('called_msisdn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- destination_network -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Destination Network</label>
                        <input type="text" name="destination_network" class="form-control @error('destination_network') is-invalid @enderror"
                               value="{{ old('destination_network', $callRecord->destination_network) }}">
                        @error('destination_network')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- destination_zone -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Destination Zone</label>
                        <input type="text" name="destination_zone" class="form-control @error('destination_zone') is-invalid @enderror"
                               value="{{ old('destination_zone', $callRecord->destination_zone) }}">
                        @error('destination_zone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- traffic_type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Traffic Type</label>
                        <input type="text" name="traffic_type" class="form-control @error('traffic_type') is-invalid @enderror"
                               value="{{ old('traffic_type', $callRecord->traffic_type) }}">
                        @error('traffic_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- apn -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">APN</label>
                        <input type="text" name="apn" class="form-control @error('apn') is-invalid @enderror"
                               value="{{ old('apn', $callRecord->apn) }}">
                        @error('apn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- rating_group -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating Group</label>
                        <input type="text" name="rating_group" class="form-control @error('rating_group') is-invalid @enderror"
                               value="{{ old('rating_group', $callRecord->rating_group) }}">
                        @error('rating_group')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- message_type_indicator -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Message Type Indicator</label>
                        <input type="text" name="message_type_indicator" class="form-control @error('message_type_indicator') is-invalid @enderror"
                               value="{{ old('message_type_indicator', $callRecord->message_type_indicator) }}">
                        @error('message_type_indicator')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- bearer_type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Bearer Type</label>
                        <input type="text" name="bearer_type" class="form-control @error('bearer_type') is-invalid @enderror"
                               value="{{ old('bearer_type', $callRecord->bearer_type) }}">
                        @error('bearer_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- roaming -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Roaming</label>
                        <select name="roaming" class="form-select @error('roaming') is-invalid @enderror">
                            <option value="">— Select —</option>
                            <option value="1" {{ old('roaming', $callRecord->roaming) == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('roaming', $callRecord->roaming) == '0' && old('roaming', $callRecord->roaming) !== null && old('roaming', $callRecord->roaming) !== '' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('roaming')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- subscriber_location -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subscriber Location</label>
                        <input type="text" name="subscriber_location" class="form-control @error('subscriber_location') is-invalid @enderror"
                               value="{{ old('subscriber_location', $callRecord->subscriber_location) }}">
                        @error('subscriber_location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- location_network -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location Network</label>
                        <input type="text" name="location_network" class="form-control @error('location_network') is-invalid @enderror"
                               value="{{ old('location_network', $callRecord->location_network) }}">
                        @error('location_network')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- location_zone -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location Zone</label>
                        <input type="text" name="location_zone" class="form-control @error('location_zone') is-invalid @enderror"
                               value="{{ old('location_zone', $callRecord->location_zone) }}">
                        @error('location_zone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- answer_time -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Answer Time</label>
                        <input type="datetime-local" name="answer_time" class="form-control @error('answer_time') is-invalid @enderror"
                               value="{{ old('answer_time', $callRecord->answer_time ? $callRecord->answer_time->format('Y-m-d\TH:i') : '') }}">
                        @error('answer_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- max_call_cost -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Max Call Cost</label>
                        <input type="number" step="0.000001" name="max_call_cost" class="form-control @error('max_call_cost') is-invalid @enderror"
                               value="{{ old('max_call_cost', $callRecord->max_call_cost) }}">
                        @error('max_call_cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- call_duration -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Call Duration</label>
                        <input type="number" name="call_duration" class="form-control @error('call_duration') is-invalid @enderror"
                               value="{{ old('call_duration', $callRecord->call_duration) }}">
                        @error('call_duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- ticket_call_duration -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ticket Call Duration</label>
                        <input type="number" name="ticket_call_duration" class="form-control @error('ticket_call_duration') is-invalid @enderror"
                               value="{{ old('ticket_call_duration', $callRecord->ticket_call_duration) }}">
                        @error('ticket_call_duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- charged_duration -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Charged Duration</label>
                        <input type="number" name="charged_duration" class="form-control @error('charged_duration') is-invalid @enderror"
                               value="{{ old('charged_duration', $callRecord->charged_duration) }}">
                        @error('charged_duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- ticket_charged_duration -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ticket Charged Duration</label>
                        <input type="number" name="ticket_charged_duration" class="form-control @error('ticket_charged_duration') is-invalid @enderror"
                               value="{{ old('ticket_charged_duration', $callRecord->ticket_charged_duration) }}">
                        @error('ticket_charged_duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- nr_of_segments -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nr of Segments</label>
                        <input type="number" name="nr_of_segments" class="form-control @error('nr_of_segments') is-invalid @enderror"
                               value="{{ old('nr_of_segments', $callRecord->nr_of_segments) }}">
                        @error('nr_of_segments')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- transferred_units -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Transferred Units</label>
                        <input type="number" name="transferred_units" class="form-control @error('transferred_units') is-invalid @enderror"
                               value="{{ old('transferred_units', $callRecord->transferred_units) }}">
                        @error('transferred_units')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- transferred_bytes -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Transferred Bytes</label>
                        <input type="number" name="transferred_bytes" class="form-control @error('transferred_bytes') is-invalid @enderror"
                               value="{{ old('transferred_bytes', $callRecord->transferred_bytes) }}">
                        @error('transferred_bytes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- ticket_transferred_bytes -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ticket Transferred Bytes</label>
                        <input type="number" name="ticket_transferred_bytes" class="form-control @error('ticket_transferred_bytes') is-invalid @enderror"
                               value="{{ old('ticket_transferred_bytes', $callRecord->ticket_transferred_bytes) }}">
                        @error('ticket_transferred_bytes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- charged_bytes -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Charged Bytes</label>
                        <input type="number" name="charged_bytes" class="form-control @error('charged_bytes') is-invalid @enderror"
                               value="{{ old('charged_bytes', $callRecord->charged_bytes) }}">
                        @error('charged_bytes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- ticket_charged_bytes -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ticket Charged Bytes</label>
                        <input type="number" name="ticket_charged_bytes" class="form-control @error('ticket_charged_bytes') is-invalid @enderror"
                               value="{{ old('ticket_charged_bytes', $callRecord->ticket_charged_bytes) }}">
                        @error('ticket_charged_bytes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- number_of_sms -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Number of SMS</label>
                        <input type="number" name="number_of_sms" class="form-control @error('number_of_sms') is-invalid @enderror"
                               value="{{ old('number_of_sms', $callRecord->number_of_sms) }}">
                        @error('number_of_sms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- ticket_number_of_sms -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ticket Number of SMS</label>
                        <input type="number" name="ticket_number_of_sms" class="form-control @error('ticket_number_of_sms') is-invalid @enderror"
                               value="{{ old('ticket_number_of_sms', $callRecord->ticket_number_of_sms) }}">
                        @error('ticket_number_of_sms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- reference_number -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Reference Number</label>
                        <input type="text" name="reference_number" class="form-control @error('reference_number') is-invalid @enderror"
                               value="{{ old('reference_number', $callRecord->reference_number) }}">
                        @error('reference_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- charge_free_action -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Charge Free Action</label>
                        <select name="charge_free_action" class="form-select @error('charge_free_action') is-invalid @enderror">
                            <option value="">— Select —</option>
                            <option value="1" {{ old('charge_free_action', $callRecord->charge_free_action) == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('charge_free_action', $callRecord->charge_free_action) == '0' && old('charge_free_action', $callRecord->charge_free_action) !== null && old('charge_free_action', $callRecord->charge_free_action) !== '' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('charge_free_action')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- tariff -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tariff</label>
                        <input type="text" name="tariff" class="form-control @error('tariff') is-invalid @enderror"
                               value="{{ old('tariff', $callRecord->tariff) }}">
                        @error('tariff')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- pool_id -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pool ID</label>
                        <input type="text" name="pool_id" class="form-control @error('pool_id') is-invalid @enderror"
                               value="{{ old('pool_id', $callRecord->pool_id) }}">
                        @error('pool_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- account_descriptor_id -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Account Descriptor ID</label>
                        <input type="text" name="account_descriptor_id" class="form-control @error('account_descriptor_id') is-invalid @enderror"
                               value="{{ old('account_descriptor_id', $callRecord->account_descriptor_id) }}">
                        @error('account_descriptor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- account_reference_id -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Account Reference ID</label>
                        <input type="text" name="account_reference_id" class="form-control @error('account_reference_id') is-invalid @enderror"
                               value="{{ old('account_reference_id', $callRecord->account_reference_id) }}">
                        @error('account_reference_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- account_difference -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Account Difference</label>
                        <input type="number" step="any" name="account_difference" class="form-control @error('account_difference') is-invalid @enderror"
                               value="{{ old('account_difference', $callRecord->account_difference) }}">
                        @error('account_difference')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- charge_amount -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Charge Amount</label>
                        <input type="number" step="any" name="charge_amount" class="form-control @error('charge_amount') is-invalid @enderror"
                               value="{{ old('charge_amount', $callRecord->charge_amount) }}">
                        @error('charge_amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- account_id -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Account ID</label>
                        <input type="text" name="account_id" class="form-control @error('account_id') is-invalid @enderror"
                               value="{{ old('account_id', $callRecord->account_id) }}">
                        @error('account_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- currency -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Currency</label>
                        <input type="text" name="currency" class="form-control @error('currency') is-invalid @enderror"
                               value="{{ old('currency', $callRecord->currency) }}">
                        @error('currency')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- closing_balance -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Closing Balance</label>
                        <input type="number" step="0.000001" name="closing_balance" class="form-control @error('closing_balance') is-invalid @enderror"
                               value="{{ old('closing_balance', $callRecord->closing_balance) }}">
                        @error('closing_balance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- account_type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Account Type</label>
                        <input type="text" name="account_type" class="form-control @error('account_type') is-invalid @enderror"
                               value="{{ old('account_type', $callRecord->account_type) }}">
                        @error('account_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- crce_result_code -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CRCE Result Code</label>
                        <input type="text" name="crce_result_code" class="form-control @error('crce_result_code') is-invalid @enderror"
                               value="{{ old('crce_result_code', $callRecord->crce_result_code) }}">
                        @error('crce_result_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- rating_filter_id -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating Filter ID</label>
                        <input type="text" name="rating_filter_id" class="form-control @error('rating_filter_id') is-invalid @enderror"
                               value="{{ old('rating_filter_id', $callRecord->rating_filter_id) }}">
                        @error('rating_filter_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- revenue_code -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Revenue Code</label>
                        <input type="text" name="revenue_code" class="form-control @error('revenue_code') is-invalid @enderror"
                               value="{{ old('revenue_code', $callRecord->revenue_code) }}">
                        @error('revenue_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- transparent_data -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Transparent Data</label>
                        <textarea name="transparent_data" rows="3" class="form-control @error('transparent_data') is-invalid @enderror">{{ old('transparent_data', $callRecord->transparent_data) }}</textarea>
                        @error('transparent_data')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- additional_rating_information -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Additional Rating Information</label>
                        <textarea name="additional_rating_information" rows="3" class="form-control @error('additional_rating_information') is-invalid @enderror">{{ old('additional_rating_information', $callRecord->additional_rating_information) }}</textarea>
                        @error('additional_rating_information')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('call-records.show', $callRecord) }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>
        </div>
    </div>

@endsection
