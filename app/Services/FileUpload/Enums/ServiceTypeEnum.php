<?php

namespace App\Services\FileUpload\Enums;

enum ServiceTypeEnum: string
{
    CASE IVR_SELF_CARE = "IVR_SELFCARE";
    CASE CRM = "CRM";
    CASE USSD_SELF_CARE = "USSD_SELFCARE";
    CASE AUTOMATIC = "AUTOMATIC";
    CASE EXTERNAL = "EXTERNAL";
    CASE PROVISIONING = "PROVISIONING";
    CASE CAMPAIGN = "CAMPAIGN";
    CASE OTHER = "OTHER";
}
