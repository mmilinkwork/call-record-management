<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmationRecord extends Model
{
    protected $fillable = [
        'crce_operation',
        'active_feature',
        'sequence_total',
        'bundle_code',
        'oppId',
        'service_type',
        'customer_care_user',
        'subscriber_language',
        'subscriber_imsi',
    ];
}
