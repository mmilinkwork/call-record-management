<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmationRecordInvalid extends Model
{
    protected $fillable = [
        'record',
        'message'
    ];
}
