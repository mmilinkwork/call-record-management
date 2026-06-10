<?php

namespace App\Services\FileUpload\Enums;

enum CrceOperationEnum: string
{
    case CHARGE = 'Charge';
    case FINAL_COMMIT = 'FinalCommit';
    case FALLBACK_SCP = 'FallbackScp';
    case FALLBACK_CRCE = 'FallbackCrce';
}
