<?php

namespace App\Services\FileUpload\Mapping;

use App\Services\FileUpload\Contracts\FileMappingInterface;
use Carbon\Carbon;

abstract class FileMapper implements FileMappingInterface
{
    /**
     * Convert format from file to format that is compatible with our system.
     *
     * @param string $timestamp
     * @return Carbon|null
     */
    protected function convertToCarbon(string $timestamp): ?Carbon
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
    protected function nullIfEmpty(mixed $value): mixed
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
    protected function returnBooleanFromString(string $boolValue): ?bool
    {
        return is_null($this->nullIfEmpty($boolValue)) ? null : filter_var($boolValue, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Return null or integer. Sometimes instead of integer we have empty string. So we need to return null.
     *
     * @param string $intValue
     * @return int|null
     */
    protected function returnIntegerFromString(string $intValue): ?int
    {
        return is_null($this->nullIfEmpty($intValue)) ? null : intval($intValue);
    }
}
