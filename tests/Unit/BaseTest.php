<?php

namespace Tests\Unit;

use App\Services\FileUpload\Enums\CrceOperationEnum;
use App\Services\FileUpload\Enums\FeatureEnum;
use App\Services\FileUpload\Enums\ServiceTypeEnum;
use App\Services\FileUpload\Enums\TrafficTypeEnum;
use App\Services\FileUpload\Mapping\CallRecordMapper;
use App\Services\FileUpload\Mapping\ConfirmationRecordMapper;
use Faker\Factory;
use Tests\TestCase;

class BaseTest extends TestCase
{
    /**
     * Generate fake data for SingleRowDTO.
     *
     * @return CallRecordMapper
     */
    protected function generateCallRecordFileMapper(): CallRecordMapper
    {
        return new CallRecordMapper($this->singleRecordData());
    }

    /**
     * Generate fake data for ConfirmationRecordMapper.
     *
     * @return ConfirmationRecordMapper
     */
    protected function generateConfirmationRecordFileMapper(): ConfirmationRecordMapper
    {
        return new ConfirmationRecordMapper($this->singleConfirmationRecordData());
    }

    /**
     * Return data with expected dummy values for a single confirmation record row.
     * Keys are 1-based to match the output of ValidateFileRecordsService::parseSingleRow().
     *
     * @return array
     */
    private function singleConfirmationRecordData(): array
    {
        $faker = Factory::create();

        return [
            25 => CrceOperationEnum::FINAL_COMMIT->value,
            26 => FeatureEnum::BASIC_SESSION->value,
            27 => (string) $faker->numberBetween(1, 10),
            28 => $faker->numerify('BUNDLE###'),
            29 => (string) $faker->numberBetween(10000, 99999),
            30 => ServiceTypeEnum::CRM->value,
            31 => $faker->userName(),
            32 => $faker->languageCode(),
            33 => $faker->numerify('228692000######'),
        ];
    }

    /**
     * Return data with expected dummy values for single row record.
     *
     * @return array
     */
    private function singleRecordData(): array
    {
        $faker = Factory::create();

        return [
            25 => CrceOperationEnum::FINAL_COMMIT->value,
            26 => FeatureEnum::BASIC_SESSION->value,
            27 => $faker->numberBetween(1, 10),
            28 => $faker->numerify('228692000######'),
            29 => $faker->uuid(),
            30 => 'true',
            31 => $faker->phoneNumber(),
            32 => $faker->randomNumber(5),
            33 => $faker->word(),
            34 => TrafficTypeEnum::DATA->value,
            35 => $faker->domainWord(),
            36 => $faker->numberBetween(100, 999),
            37 => null,
            38 => 'GPRS',
            39 => $faker->boolean(),
            40 => $faker->randomNumber(4, true),
            41 => $faker->country(),
            42 => $faker->word(),
            43 => "2023-03-27T04:14:24.000+0000",
            44 => $faker->randomFloat(2, 0, 10),
            45 => $faker->numberBetween(100, 100000),
            46 => $faker->numberBetween(100, 100000),
            47 => 0,
            48 => 0,
            49 => $faker->numberBetween(1, 10000),
            50 => $faker->numberBetween(1, 100000),
            51 => $faker->numberBetween(1, 100000),
            52 => $faker->numberBetween(1, 100000),
            53 => $faker->numberBetween(1, 100000),
            54 => $faker->numberBetween(1, 100000),
            55 => 0,
            56 => 0,
            57 => $faker->uuid(),
            58 => "false",
            59 => $faker->numberBetween(100000, 999999),
            60 => $faker->randomNumber(4),
            61 => $faker->numberBetween(100000, 999999),
            62 => (string) $faker->numberBetween(100000, 999999),
            63 => $faker->numberBetween(1, 100),
            64 => $faker->numberBetween(1, 100),
            65 => $faker->numberBetween(1000000000, 9999999999),
            66 => 'MB',
            67 => $faker->numberBetween(100000, 999999),
            68 => 'PREPAID',
            69 => 'OK',
            70 => $faker->numberBetween(1000000000, 9999999999),
            71 => null,
            72 => null,
            73 => null,
        ];
    }
}
