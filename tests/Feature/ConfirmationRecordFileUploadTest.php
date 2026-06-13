<?php

namespace Tests\Feature;

use App\Models\ConfirmationRecord;
use App\Models\ConfirmationRecordInvalid;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class ConfirmationRecordFileUploadTest extends BaseTest
{
    use RefreshDatabase;

    /**
     * The test ensures that we have valid flow for valid and invalid confirmation records ingestion.
     * 1. Why we are doing this test:
     *
     *      The application processes uploaded confirmation record files through multiple layers:
     *      file parsing, DTO mapping, validation and database persistence.
     *      Any unexpected change in this flow could result in valid records being rejected
     *      or invalid records being persisted.
     *
     * 2. What is the logic for this test:
     *
     *      A test file containing both valid and invalid confirmation record rows is uploaded
     *      through the same entry point used by the application.
     *      Valid records must be stored in the confirmation_records table,
     *      while invalid records must be stored in the confirmation_record_invalids table.
     *
     * 3. What is the purpose for this test:
     *
     *      To protect the ingestion pipeline from regressions and ensure that
     *      record classification remains consistent during future development.
     *
     * @return void
     */
    public function test_confirmation_record_ingestion_process_separates_valid_and_invalid_records(): void
    {
        $file = UploadedFile::fake()->createWithContent(
            'confirmation.txt',
            $this->generateConfirmationFileContent()
        );

        $this->post(
            route('confirmation-records.store'),
            ['file' => $file]
        );

        $this->assertEquals(ConfirmationRecord::all()->count(), 3);
        $this->assertEquals(ConfirmationRecordInvalid::all()->count(), 7);
        $this->assertDatabaseHas('confirmation_records', [
            'subscriber_imsi' => '228692000001',
        ]);
    }
}
