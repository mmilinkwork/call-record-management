<?php

use App\Http\Controllers\Frontend\CallChargeRecordController;
use Illuminate\Support\Facades\Route;

Route::resource('/call-records', CallChargeRecordController::class);
