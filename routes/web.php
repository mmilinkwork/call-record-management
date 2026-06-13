<?php

use App\Http\Controllers\Frontend\CallChargeRecordController;
use App\Http\Controllers\Frontend\ConfirmationRecordController;
use App\Http\Controllers\Frontend\ConfirmationRecordInvalidController;
use Illuminate\Support\Facades\Route;

Route::resource('/call-records', CallChargeRecordController::class);
Route::get('/call-records-export-pdf', [CallChargeRecordController::class, 'exportPdf'])->name('call-records.export-pdf');
Route::resource('/confirmation-records', ConfirmationRecordController::class);
Route::get('/confirmation-records-export-pdf', [ConfirmationRecordController::class, 'exportPdf'])->name('confirmation-records.export-pdf');
Route::resource('/confirmation-record-invalids', ConfirmationRecordInvalidController::class);
Route::get('/confirmation-record-invalids-export-pdf', [ConfirmationRecordInvalidController::class, 'exportPdf'])->name('confirmation-record-invalids.export-pdf');
