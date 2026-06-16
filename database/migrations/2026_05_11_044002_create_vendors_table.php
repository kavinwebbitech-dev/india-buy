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
        Schema::create('vendors', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->unsignedBigInteger('vendor_type_id')->nullable();

            $table->unsignedBigInteger('business_id')->nullable();

            $table->string('company_name')->nullable();

            $table->string('company_logo')->nullable();

            $table->longText('about_us')->nullable();

            $table->year('year_established')->nullable();

            $table->string('country')->nullable();

            $table->string('state')->nullable();

            $table->string('city')->nullable();

            $table->longText('address')->nullable();

            $table->string('phone')->nullable();

            $table->string('email')->unique();

            $table->string('gst_no')->nullable();

            $table->string('otp')->nullable();

            $table->timestamp('otp_expired_at')->nullable();

            $table->tinyInteger('status')->default(1);

            $table->tinyInteger('email_verify')->default(0);

            $table->timestamp('email_verify_at')->nullable();

            $table->string('password');

            $table->rememberToken();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
