<?php

namespace Tests\Unit;

use App\Models\CallChargeRecord;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CallChargeRecordMappingTest extends BaseTest
{
    use RefreshDatabase;

    /**
     * This test ensures structural contract integrity between SingleRowDTO and CallChargeRecord Eloquent model.
     * 1. Why we are doing this test:
     *      We are working with a strict file → DTO → database pipeline where data is ingested in bulk.
     *      Any change in DTO structure or mapping can silently break data persistence or cause field loss without runtime errors.
     *      This test exists to prevent unnoticed contract drift between layers.
     *
     * 2. What is the logic for this test:
     *      The test compares the output of SingleRowDTO::toArray() against the CallChargeRecord model's $fillable definition.
     *      Since toArray() is responsible for preparing data for bulk insert, it must match exactly what the Eloquent model allows for mass assignment.
     *      Any mismatch (missing or extra fields) will cause the test to fail.
     *
     * 3. What is the purpose for this test:
     *      The purpose is to guarantee that DTO output remains fully aligned with the database insertion contract.
     *      This protects the system from silent data loss, broken mappings, or incomplete inserts during bulk processing.
     */
    public function test_dto_keys_match_model_fillable_for_bulk_insert(): void
    {
        $callChargeRecordModelKeys = (new CallChargeRecord())->getFillable();

        $singleRowDtoKeys = array_keys($this->generateCallRecordFileMapper()->toArray());

        $this->assertSame(
            $callChargeRecordModelKeys,  // expected: the model is the contract
            $singleRowDtoKeys,           // actual: the DTO must conform to it
            'DTO keys do not match model $fillable — bulk insert contract broken'
        );
    }
}
