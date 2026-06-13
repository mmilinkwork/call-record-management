<?php

use App\Services\FileUpload\Enums\ServiceTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('confirmation_records', function (Blueprint $table) {
            $table->id();

            $table->string('crce_operation');
            $table->string('active_feature')->nullable();
            $table->integer('sequence_total')->nullable();
            $table->string('bundle_code')->nullable();
            $table->integer('oppId')->nullable();

            $table->enum('service_type', array_column(ServiceTypeEnum::cases(), 'value'))->nullable();

            $table->string('customer_care_user')->nullable();
            $table->string('subscriber_language');
            $table->string('subscriber_imsi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmation_records');
    }
};
