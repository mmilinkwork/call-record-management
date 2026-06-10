<?php

namespace App\Services\FileUpload\Enums;

enum TrafficTypeEnum: string
{
    case ORIGINATING = 'Originating';
    case FORWARDING = 'Forwarding';
    case TERMINATING = 'Terminating';
    case SHORT_MESSAGE = 'ShortMessage';
    case DATA = 'Data';
    case USSD = 'USSD';
    case MMS_MO = 'MMS_MO';
}
