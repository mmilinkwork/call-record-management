<?php

namespace App\Services\FileUpload\Validations;

use App\Services\FileUpload\Contracts\FileMappingInterface;
use App\Services\FileUpload\Contracts\Validation\ValidationResultInterface;
use App\Services\FileUpload\Enums\CrceOperationEnum;
use App\Services\FileUpload\Enums\FeatureEnum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CallChargeRecordRowValidation extends RowValidation
{
    private Collection $errors;

    public function __construct()
    {
        $this->errors = collect();
    }

    /**
     * Validate all fields, especially condition fields that are described into documentation.
     * Documentation link: https://www.example.org/pscharfen-CRCECONF-ConfirmationRecord-280423-0734-135.pdf
     *
     * @param FileMappingInterface $record
     * @return ValidationResult
     */
    public function validate(FileMappingInterface $record): ValidationResultInterface
    {
        $validator = Validator::make(data: $record->toArray(), rules: $this->rules());

        if ($validator->fails())
        {
            $this->errors->push((object)[
                'record' => $record->toJson(),
                'errors' => $validator->errors()->toJson()
            ]);
        }

        return new ValidationResult(
            passes: $this->errors->count() === 0,
            errors: $this->errors
        );
    }

    /**
     * Write down all rules that we need for field check. If something from these rules doesn't work, we will set row
     * into array of errors and display those errors to user.
     *
     * @return array
     */
    private function rules(): array
    {
        return [
            'crce_operation' => ['required', Rule::enum(CrceOperationEnum::class)],
            'charge_mode' => ['required', Rule::enum(FeatureEnum::class)],
            'sequence_total' => ['nullable', 'integer'],
            'imsi' => ['required', 'string']
        ];
    }
}
