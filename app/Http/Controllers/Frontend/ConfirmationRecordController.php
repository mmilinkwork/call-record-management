<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmationRecordsStoreRequest;

class ConfirmationRecordController extends Controller
{
    public function create()
    {
        return view('confirmation_records.upload');
    }

    public function store(ConfirmationRecordsStoreRequest $confirmationRecordsStoreRequest)
    {

    }
}
