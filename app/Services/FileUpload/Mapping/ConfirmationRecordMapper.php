<?php

namespace App\Services\FileUpload\Mapping;

use App\Services\FileUpload\Enums\ConfirmationRecordMapperEnum;
use App\Services\FileUpload\Mapping\FileMapper;

class ConfirmationRecordMapper extends FileMapper
{
    public readonly string $operation; //crce_operation
    public readonly ?string $feature; //active_feature
    public readonly ?int $sequenceTotal; //sequence_total
    public readonly ?string $bundleCode; //bundle_code
    public readonly ?int $oppId;//oppId
    public readonly ?string $serviceType;
    public readonly ?string $customerCareUser; //customer_care_user
    public readonly string $subscriberLanguage; //subscriber_language
    public readonly string $subscriberImsi; //imsi

    public function __construct(array $record)
    {
        $this->operation = $this->nullIfEmpty($record[ConfirmationRecordMapperEnum::OPERATION->value]);
        $this->feature = $this->nullIfEmpty($record[ConfirmationRecordMapperEnum::FEATURE->value]);
        $this->sequenceTotal = $this->returnIntegerFromString($record[ConfirmationRecordMapperEnum::SEQUENCE_TOTAL->value]);
        $this->bundleCode = $this->nullIfEmpty($record[ConfirmationRecordMapperEnum::BUNDLE_CODE->value]);
        $this->oppId = $this->returnIntegerFromString($record[ConfirmationRecordMapperEnum::OPP_ID->value]);
        $this->serviceType = $this->nullIfEmpty($record[ConfirmationRecordMapperEnum::SERVICE_TYPE->value]);
        $this->customerCareUser = $this->nullIfEmpty($record[ConfirmationRecordMapperEnum::CUSTOMER_CARE_USER->value]);
        $this->subscriberLanguage = $this->nullIfEmpty($record[ConfirmationRecordMapperEnum::SUBSCRIBER_LANGUAGE->value]);
        $this->subscriberImsi = $this->nullIfEmpty($record[ConfirmationRecordMapperEnum::SUBSCRIBER_IMSI->value]);
    }

    /**
     * Transforms field to key => value pairs so we can use it in bulk injections.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'crce_operation'        => $this->operation,
            'active_feature'        => $this->feature,
            'sequence_total'        => $this->sequenceTotal,
            'bundle_code'           => $this->bundleCode,
            'oppId'                 => $this->oppId,
            'service_type'          => $this->serviceType,
            'customer_care_user'    => $this->customerCareUser,
            'subscriber_language'   => $this->subscriberLanguage,
            'subscriber_imsi'       => $this->subscriberImsi
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
}
