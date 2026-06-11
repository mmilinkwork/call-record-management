<?php

use App\Services\FileUpload\Enums\CrceOperationEnum;
use App\Services\FileUpload\Enums\FeatureEnum;
use App\Services\FileUpload\Enums\TrafficTypeEnum;
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
        Schema::create('call_charge_records', function (Blueprint $table) {
            $table->id();

            $table->enum('crce_operation', [
                CrceOperationEnum::CHARGE,
                CrceOperationEnum::FINAL_COMMIT,
                CrceOperationEnum::FALLBACK_SCP,
                CrceOperationEnum::FALLBACK_CRCE,
            ]);

            $table->enum('charge_mode', [
                FeatureEnum::BASIC_EVENT,
                FeatureEnum::BASIC_SESSION
            ]);

            $table->unsignedBigInteger('sequence_total')->nullable();

            $table->string('imsi');
            $table->string('calling_msisdn');
            $table->boolean('clip_suppress_number');

            $table->string('called_msisdn')->nullable();
            $table->string('destination_network')->nullable();
            $table->string('destination_zone')->nullable();

            $table->enum('traffic_type', [
                TrafficTypeEnum::SHORT_MESSAGE,
                TrafficTypeEnum::DATA,
                TrafficTypeEnum::FORWARDING,
                TrafficTypeEnum::MMS_MO,
                TrafficTypeEnum::ORIGINATING,
                TrafficTypeEnum::TERMINATING,
                TrafficTypeEnum::USSD
            ]);

            $table->string('apn')->nullable();
            $table->unsignedBigInteger('rating_group')->nullable();
            $table->string('message_type_indicator')->nullable();
            $table->string('bearer_type')->nullable();
            $table->boolean('roaming')->default(false);

            $table->string('subscriber_location')->nullable();
            $table->string('location_network')->nullable();
            $table->string('location_zone')->nullable();

            $table->timestamp('answer_time')->nullable();

            $table->unsignedBigInteger('max_call_cost')->nullable();

            $table->unsignedBigInteger('call_duration')->nullable();
            $table->unsignedBigInteger('ticket_call_duration')->nullable();
            $table->unsignedBigInteger('charged_duration')->nullable();
            $table->unsignedBigInteger('ticket_charged_duration')->nullable();

            $table->unsignedBigInteger('nr_of_segments')->nullable();

            $table->unsignedBigInteger('transferred_units')->nullable();
            $table->unsignedBigInteger('transferred_bytes')->nullable();
            $table->unsignedBigInteger('ticket_transferred_bytes')->nullable();
            $table->unsignedBigInteger('charged_bytes')->nullable();
            $table->unsignedBigInteger('ticket_charged_bytes')->nullable();

            $table->unsignedInteger('number_of_sms')->nullable();
            $table->unsignedInteger('ticket_number_of_sms')->nullable();

            $table->string('reference_number')->unique();

            $table->boolean('charge_free_action');

            $table->unsignedBigInteger('tariff');
            $table->unsignedBigInteger('pool_id')->nullable();
            $table->unsignedBigInteger('account_descriptor_id');
            $table->unsignedBigInteger('account_reference_id')->nullable();

            $table->unsignedBigInteger('account_difference');
            $table->unsignedBigInteger('charge_amount');

            $table->unsignedBigInteger('account_id')->nullable();
            $table->string('currency', 255);
            $table->unsignedBigInteger('closing_balance');

            $table->string('account_type')->nullable();

            $table->string('crce_result_code');

            $table->unsignedBigInteger('rating_filter_id')->nullable();
            $table->string('revenue_code')->nullable();

            $table->text('transparent_data')->nullable();
            $table->text('additional_rating_information')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_charge_records');
    }
};
