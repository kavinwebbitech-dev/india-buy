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
        Schema::create('real_estates', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('vendor_id');

            $table->unsignedBigInteger('vendor_type_id');

            // CATEGORY
            $table->unsignedBigInteger('category_id')->nullable();

            // SUB CATEGORY
            $table->unsignedBigInteger('sub_category_id')->nullable();

            $table->string('property_title');

            $table->string('property_type')->nullable();

            $table->string('property_for')->nullable();

            $table->longText('descripction')->nullable();

            $table->string('state')->nullable();

            $table->string('city')->nullable();

            $table->text('address')->nullable();

            $table->string('landmark')->nullable();

            // JSON ARRAY
            $table->longText('specification')->nullable();

            // JSON ARRAY
            $table->longText('features')->nullable();

            // JSON ARRAY
            $table->longText('proerty_image')->nullable();

            $table->longText('datasheet')->nullable();

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
        Schema::dropIfExists('real_estates');
    }
};