<?php

use App\Http\Controllers\Frontend\CallChargeRecordController;
use App\Http\Controllers\Frontend\ConfirmationRecordController;
use Illuminate\Support\Facades\Route;

Route::resource('/call-records', CallChargeRecordController::class);
Route::get('/call-records-export-pdf', [CallChargeRecordController::class, 'exportPdf'])->name('call-records.export-pdf');
Route::resource('/confirmation-records', ConfirmationRecordController::class);
