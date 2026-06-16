<?php

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
        Schema::create('services', function (Blueprint $table) {

            $table->id();

            // BASIC
            $table->string('service_name');

            $table->unsignedBigInteger('category')->nullable();

            $table->unsignedBigInteger('subcategory')->nullable();

            $table->text('short_description')->nullable();

            $table->longText('long_description')->nullable();

            // PRICE
            $table->string('price_type')->nullable();

            // LOCATION
            $table->string('service_state')->nullable();

            $table->string('service_city')->nullable();

            // FILES
            $table->string('datasheet')->nullable();

            // MULTIPLE IMAGES JSON
            $table->longText('service_img')->nullable();

            // FEATURES JSON
            $table->longText('feature')->nullable();

            // AVAILABLE DAYS JSON
            $table->longText('available_days')->nullable();

            // TIMING
            $table->time('opening_time')->nullable();

            $table->time('closing_time')->nullable();

            // VENDOR
            $table->unsignedBigInteger('vendor_id');

            $table->unsignedBigInteger('vendor_type_id');

            // STATUS
            $table->tinyInteger('status')
                  ->default(0)
                  ->comment('0=Inactive,1=Active');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};