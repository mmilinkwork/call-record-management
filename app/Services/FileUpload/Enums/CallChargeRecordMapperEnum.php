<?php

namespace App\Services\FileUpload\Enums;

enum CallChargeRecordMapperEnum: int
{
    case OPERATION = 25; // crce_operation
    case FEATURE = 26; // charge_mode
    case SEQUENCE_TOTAL = 27; // sequence_total
    case SUBSCRIBER_IMSI = 28; // imsi
    case CALLING_PARTY_ADDRESS = 29; // calling_msisdn
    case IS_CALLER_ID_SUPPRESSED = 30; // clip_suppress_number
    case CALLED_PARTY_ADDRESS = 31; // called_msisdn
    case DESTINATION_NETWORK = 32; // destination_network
    case DESTINATION_ZONE = 33; // destination_zone
    case TRAFFIC_TYPE = 34; // traffic_type
    case APN = 35; // apn
    case RATING_GROUP_ID = 36; // rating_group_id
    case MESSAGE_TYPE = 37; // message_type_indicator
    case BEARER_TYPE = 38; // bearer_type
    case IS_ROAMING = 39; // roaming
    case SUBSCRIBER_LOCATION = 40; // subscriber_location
    case LOCATION_NETWORK = 41; // location_network
    case LOCATION_ZONE = 42; // location_zone
    case ANSWER_TIME = 43; // answer_time
    case MAXIMUM_CALL_COST = 44; // maximum_call_cost
    case CALL_DURATION = 45; // call_duration
    case TICKET_CALL_DURATION = 46; // ticket_call_duration
    case CHARGED_DURATION = 47; // charged_duration
    case TICKET_CHARGED_DURATION = 48; // ticket_charged_duration
    case NUMBER_OF_SEGMENTS = 49; // number_of_segments
    case TRANSFERRED_UNITS = 50; // transferred_units
    case TRANSFERRED_BYTES = 51; // transferred_bytes
    case TICKET_TRANSFERRED_BYTES = 52; // ticket_transferred_bytes
    case CHARGED_BYTES = 53; // charged_bytes
    case TICKET_CHARGED_BYTES = 54; // ticket_charged_bytes
    case NUMBER_OF_SMS = 55; // number_of_sms
    case TICKET_NUMBER_OF_SMS = 56; // ticket_number_of_sms
    case REFERENCE_NUMBER = 57; // reference_number
    case IS_CHARGE_FREE_ACTION = 58; // charge_free_action
    case TARIFF_ID = 59; // tariff_id
    case POOL_ID = 60; // pool_id
    case ACCOUNT_DESCRIPTOR_ID = 61; // account_descriptor_id
    case ACCOUNT_REFERENCE_ID = 62; // account_reference_id
    case ACCOUNT_DIFFERENCE = 63; // account_difference
    case CHARGE_AMOUNT = 64; // charge_amount
    case ACCOUNT_ID = 65; // account_id
    case ACCOUNT_CURRENCY = 66; // account_currency
    case ACCOUNT_CLOSING_BALANCE = 67; // account_closing_balance
    case ACCOUNT_TYPE = 68; // account_type
    case CHARGING_RESULT = 69; // charging_result
    case RATING_FILTER_ID = 70; // rating_filter_id
    case REVENUE_CODE = 71; // revenue_code
    case TRANSPARENT_DATA = 72; // transparent_data
    case ADDITIONAL_RATING_INFORMATION = 73; // additional_rating_information
}
