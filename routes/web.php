<?php

use App\Http\Controllers\Frontend\CallChargeRecordController;
use Illuminate\Support\Facades\Route;

Route::resource('/call-records', CallChargeRecordController::class);
Route::get('/call-records-export-pdf', [CallChargeRecordController::class, 'exportPdf'])->name('call-records.export-pdf');
