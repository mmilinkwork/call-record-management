<?php

namespace App\Services\FileUpload\DataTransferObjects;

use App\Services\FileUpload\Enums\CallChargeRecordMapperEnum;
use Carbon\Carbon;

class SingleRowDTO
{
    public readonly string      $operation; //crce_operation
    public readonly string      $feature; //charge_mode
    public readonly ?int        $sequenceTotal; //sequence_total
    public readonly string      $subscriberImsi; //imsi
    public readonly string      $callingPartyAddress; //calling_msisdn
    public readonly bool        $isCallerIdSuppressed; //clip_suppress_number
    public readonly ?string     $calledPartyAddress; //called_msisdn
    public readonly ?string     $destinationNetwork; //destination_network
    public readonly ?string     $destinationZone; //destination_zone
    public readonly string      $trafficType; //traffic_type
    public readonly ?string     $apn; //apn
    public readonly ?int        $ratingGroupId; //rating_group
    public readonly ?string     $messageType; //message_type_indicator
    public readonly ?string     $bearerType; //bearer_type
    public readonly ?bool       $isRoaming; //roaming
    public readonly ?string     $subscriberLocation; //subscriber_location
    public readonly ?string     $locationNetwork; //location_network
    public readonly ?string     $locationZone; //location_zone
    public readonly ?Carbon     $answerTimestamp; //answer_time -> timestamp with time zone -> pay attention
    public readonly ?int        $maximumCallCost; //max_call_cost
    public readonly ?int        $callDuration; //call_duration
    public readonly ?int        $ticketCallDuration; //ticket_call_duration
    public readonly ?int        $chargedDuration; //charged_duration
    public readonly ?int        $ticketChargedDuration; //ticket_charged_duration
    public readonly ?int        $numberOfSegments; //nr_of_segments
    public readonly ?int        $transferredUnits; //transferred_units
    public readonly ?int        $transferredBytes; //transferred_bytes
    public readonly ?int        $ticketTransferredBytes; //ticket_transferred_bytes
    public readonly ?int        $chargedBytes; //charged_bytes
    public readonly ?int        $ticketChargedBytes; //ticket_charged_bytes
    public readonly ?int        $numberOfSMS; //number_of_sms
    public readonly ?int        $ticketNumberOfSMS; //ticket_number_of_sms
    public readonly string      $referenceNumber; //reference_number
    public readonly bool        $isChargeFreeAction; //charge_free_action
    public readonly int         $tariffId; //tariff
    public readonly ?int        $poolId; //pool_id
    public readonly int         $accountDescriptorId; //account_descriptor_id
    public readonly ?string     $accountReferenceId; //account_reference_id
    public readonly int         $accountDifference; //account_difference
    public readonly int         $chargeAmount; //charge_amount
    public readonly ?int        $accountId; //account_id
    public readonly string      $accountCurrency; //currency
    public readonly int         $accountClosingBalance; //closing_balance
    public readonly ?string     $accountType; //account_type
    public readonly string      $chargingResult; //crce_result_code
    public readonly ?int        $ratingFilterId; //rating_filter_id
    public readonly ?string     $revenueCode; //revenue_code
    public readonly ?string     $transparentData; //transparent_data
    public readonly ?string     $additionalRatingInformation; //additional_rating_information

    public function __construct(array $record)
    {
        $this->operation = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::OPERATION->value]);
        $this->feature = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::FEATURE->value]);

        $this->sequenceTotal = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::SEQUENCE_TOTAL->value]);

        $this->subscriberImsi = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::SUBSCRIBER_IMSI->value]);

        $this->callingPartyAddress = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::CALLING_PARTY_ADDRESS->value]);

        $this->isCallerIdSuppressed = $this->returnBooleanFromString($record[CallChargeRecordMapperEnum::IS_CALLER_ID_SUPPRESSED->value]);

        $this->calledPartyAddress = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::CALLED_PARTY_ADDRESS->value]);

        $this->destinationNetwork = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::DESTINATION_NETWORK->value]);

        $this->destinationZone = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::DESTINATION_ZONE->value]);

        $this->trafficType = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::TRAFFIC_TYPE->value]);

        $this->apn = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::APN->value]);

        $this->ratingGroupId =  $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::RATING_GROUP_ID->value]);

        $this->messageType = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::MESSAGE_TYPE->value]);

        $this->bearerType = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::BEARER_TYPE->value]);

        $this->isRoaming = $this->returnBooleanFromString($record[CallChargeRecordMapperEnum::IS_ROAMING->value]);

        $this->subscriberLocation = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::SUBSCRIBER_LOCATION->value]);

        $this->locationNetwork = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::LOCATION_NETWORK->value]);

        $this->locationZone = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::LOCATION_ZONE->value]);

        $this->answerTimestamp = $this->convertToCarbon(
            $record[CallChargeRecordMapperEnum::ANSWER_TIME->value] ?? null
        );

        $this->maximumCallCost = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::MAXIMUM_CALL_COST->value]);

        $this->callDuration = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::CALL_DURATION->value]);

        $this->ticketCallDuration = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::TICKET_CALL_DURATION->value]);

        $this->chargedDuration = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::CHARGED_DURATION->value]);

        $this->ticketChargedDuration = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::TICKET_CHARGED_DURATION->value]);

        $this->numberOfSegments = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::NUMBER_OF_SEGMENTS->value]);

        $this->transferredUnits = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::TRANSFERRED_UNITS->value]);

        $this->transferredBytes = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::TRANSFERRED_BYTES->value]);

        $this->ticketTransferredBytes = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::TICKET_TRANSFERRED_BYTES->value]);

        $this->chargedBytes = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::CHARGED_BYTES->value]);

        $this->ticketChargedBytes = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::TICKET_CHARGED_BYTES->value]);

        $this->numberOfSMS = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::NUMBER_OF_SMS->value]);

        $this->ticketNumberOfSMS = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::TICKET_NUMBER_OF_SMS->value]);

        $this->referenceNumber = $record[CallChargeRecordMapperEnum::REFERENCE_NUMBER->value] ?? null;

        $this->isChargeFreeAction = $this->returnBooleanFromString($record[CallChargeRecordMapperEnum::IS_CHARGE_FREE_ACTION->value]);

        $this->tariffId = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::TARIFF_ID->value]);

        $this->poolId = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::POOL_ID->value]);

        $this->accountDescriptorId = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::ACCOUNT_DESCRIPTOR_ID->value]);

        $this->accountReferenceId = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::ACCOUNT_REFERENCE_ID->value]);

        $this->accountDifference = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::ACCOUNT_DIFFERENCE->value]);

        $this->chargeAmount = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::CHARGE_AMOUNT->value]);

        $this->accountId = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::ACCOUNT_ID->value]);

        $this->accountCurrency = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::ACCOUNT_CURRENCY->value]);

        $this->accountClosingBalance = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::ACCOUNT_CLOSING_BALANCE->value]);

        $this->accountType =  $this->nullIfEmpty($record[CallChargeRecordMapperEnum::ACCOUNT_TYPE->value]);

        $this->chargingResult = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::CHARGING_RESULT->value]);

        $this->ratingFilterId = $this->returnIntegerFromString($record[CallChargeRecordMapperEnum::RATING_FILTER_ID->value]);

        $this->revenueCode = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::REVENUE_CODE->value]);

        $this->transparentData = $this->nullIfEmpty($record[CallChargeRecordMapperEnum::TRANSPARENT_DATA->value]);

        $this->additionalRatingInformation =  $this->nullIfEmpty($record[CallChargeRecordMapperEnum::ADDITIONAL_RATING_INFORMATION->value]);
    }

    /**
     * Transforms field to key => value pairs so we can use it in bulk injections.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'operation' => $this->operation, // crce_operation
            'feature' => $this->feature, // charge_mode
            'sequence_total' => $this->sequenceTotal, // sequence_total
            'imsi' => $this->subscriberImsi, // imsi
            'calling_party_address' => $this->callingPartyAddress, // calling_msisdn
            'is_caller_id_suppressed' => $this->isCallerIdSuppressed, // clip_suppress_number
            'called_party_address' => $this->calledPartyAddress, // called_msisdn
            'destination_network' => $this->destinationNetwork, // destination_network
            'destination_zone' => $this->destinationZone, // destination_zone
            'traffic_type' => $this->trafficType, // traffic_type
            'apn' => $this->apn, // apn
            'rating_group_id' => $this->ratingGroupId, // rating_group
            'message_type' => $this->messageType, // message_type_indicator
            'bearer_type' => $this->bearerType, // bearer_type
            'is_roaming' => $this->isRoaming, // roaming
            'subscriber_location' => $this->subscriberLocation, // subscriber_location
            'location_network' => $this->locationNetwork, // location_network
            'location_zone' => $this->locationZone, // location_zone
            'answer_timestamp' => $this->answerTimestamp, // answer_time
            'maximum_call_cost' => $this->maximumCallCost, // max_call_cost
            'call_duration' => $this->callDuration, // call_duration
            'ticket_call_duration' => $this->ticketCallDuration, // ticket_call_duration
            'charged_duration' => $this->chargedDuration, // charged_duration
            'ticket_charged_duration' => $this->ticketChargedDuration, // ticket_charged_duration
            'number_of_segments' => $this->numberOfSegments, // nr_of_segments
            'transferred_units' => $this->transferredUnits, // transferred_units
            'transferred_bytes' => $this->transferredBytes, // transferred_bytes
            'ticket_transferred_bytes' => $this->ticketTransferredBytes, // ticket_transferred_bytes
            'charged_bytes' => $this->chargedBytes, // charged_bytes
            'ticket_charged_bytes' => $this->ticketChargedBytes, // ticket_charged_bytes
            'number_of_sms' => $this->numberOfSMS, // number_of_sms
            'ticket_number_of_sms' => $this->ticketNumberOfSMS, // ticket_number_of_sms
            'reference_number' => $this->referenceNumber, // reference_number
            'is_charge_free_action' => $this->isChargeFreeAction, // charge_free_action
            'tariff_id' => $this->tariffId, // tariff
            'pool_id' => $this->poolId, // pool_id
            'account_descriptor_id' => $this->accountDescriptorId, // account_descriptor_id
            'account_reference_id' => $this->accountReferenceId, // account_reference_id
            'account_difference' => $this->accountDifference, // account_difference
            'charge_amount' => $this->chargeAmount, // charge_amount
            'account_id' => $this->accountId, // account_id
            'account_currency' => $this->accountCurrency, // currency
            'account_closing_balance' => $this->accountClosingBalance, // closing_balance
            'account_type' => $this->accountType, // account_type
            'charging_result' => $this->chargingResult, // crce_result_code
            'rating_filter_id' => $this->ratingFilterId, // rating_filter_id
            'revenue_code' => $this->revenueCode, // revenue_code
            'transparent_data' => $this->transparentData, // transparent_data
            'additional_rating_information' => $this->additionalRatingInformation, // additional_rating_information
        ];
    }

    /**
     * Convert to JSON.
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Convert format from file to format that is compatible with our system.
     *
     * @param string $timestamp
     * @return Carbon|null
     */
    private function convertToCarbon(string $timestamp): ?Carbon
    {
        if ($timestamp === '0' || $timestamp === '')
        {
            return null;
        }

        return Carbon::createFromFormat(
            'Y-m-d\TH:i:s.vO',
            $timestamp
        );
    }

    /**
     * Return null if we have empty string. Why? Cuz our txt file with || give us empty string, actually maybe it is not
     * mandatory field, so we need to set null. It is not good practice to put empty string.
     *
     * @param mixed $value
     * @return mixed
     */
    private function nullIfEmpty(mixed $value): mixed
    {
        return ($value === '') ? null : $value;
    }

    /**
     * Return null or boolean. Sometimes instead of true/false we have empty string. So we need to return null.
     * It is safe cuz if we require field, we will get null and execution stops. Otherwise, everything is fine.
     *
     * @param string $boolValue
     * @return bool|null
     */
    private function returnBooleanFromString(string $boolValue): ?bool
    {
        return is_null($this->nullIfEmpty($boolValue)) ? null : filter_var($boolValue, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Return null or integer. Sometimes instead of integer we have empty string. So we need to return null.
     *
     * @param string $intValue
     * @return int|null
     */
    private function returnIntegerFromString(string $intValue): ?int
    {
        return is_null($this->nullIfEmpty($intValue)) ? null : intval($intValue);
    }

}
