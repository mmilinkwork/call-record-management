<?php

namespace Tests\Feature;

use App\Models\CallChargeRecord;
use App\Services\FileUpload\ProcessChargeRecordService;
use Illuminate\Http\UploadedFile;

class CallChargeRecordFileUploadTest extends BaseTest
{
    public function test_valid_cdr_file_is_successfully_imported(): void
    {
        $file = UploadedFile::fake()->createWithContent(
            'cdr.txt',
            $this->generateValidFileContent()
        );

        $service = new ProcessChargeRecordService();
        $service->setFile($file)->dispatchProcessing();

        $this->assertEquals(CallChargeRecord::all()->count(), 3);
    }
}
