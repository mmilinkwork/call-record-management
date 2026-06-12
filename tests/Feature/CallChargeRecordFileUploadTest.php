<?php

namespace Tests\Feature;

use App\Models\CallChargeRecord;
use App\Models\CallChargeRecordInvalid;
use App\Services\FileUpload\ProcessFileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class CallChargeRecordFileUploadTest extends BaseTest
{
    use RefreshDatabase;

    /**
     * The test ensures that we have valid flow for valid and invalid call records ingestion.
     * 1. Why we are doing this test:
     *
     *      The application processes uploaded CDR files through multiple layers:
     *      file parsing, DTO mapping, validation and database persistence.
     *      Any unexpected change in this flow could result in valid records being rejected
     *      or invalid records being persisted.
     *
     * 2. What is the logic for this test:
     *
     *      A test file containing both valid and invalid CDR rows is uploaded through
     *      the same entry point used by the application.
     *      Valid records must be stored in the call_charge_records table,
     *      while invalid records must be stored in the call_charge_record_invalids table.
     *
     * 3. What is the purpose for this test:
     *
     *      To protect the ingestion pipeline from regressions and ensure that
     *      record classification remains consistent during future development.
     *
     * @return void
     */
    public function test_cdr_ingestion_process_separates_valid_and_invalid_records(): void
    {
        $file = UploadedFile::fake()->createWithContent(
            'cdr.txt',
            $this->generateValidFileContent()
        );

        $this->post(
            route('call-records.store'),
            ['file' => $file]
        );

        $this->assertEquals(CallChargeRecord::all()->count(), 3);
        $this->assertEquals(CallChargeRecordInvalid::all()->count(), 7);
        $this->assertDatabaseHas('call_charge_records', [
            'reference_number' => 'ggsn01.mtel.at;3887679566;284;13733',
        ]);
    }
}
