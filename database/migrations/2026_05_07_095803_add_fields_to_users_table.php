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
        Schema::table('users', function (Blueprint $table) {

            $table->string('phone')->nullable()->after('email');

            $table->string('otp')->nullable()->after('phone');

            $table->timestamp('otp_expired_at')
                  ->nullable()
                  ->after('otp');

            $table->tinyInteger('status')
                  ->default(1)
                  ->after('otp_expired_at');

            $table->string('mail_otp')
                  ->nullable()
                  ->after('status');

            $table->text('address')
                  ->nullable()
                  ->after('mail_otp');

            $table->string('state')
                  ->nullable()
                  ->after('address');

            $table->string('city')
                  ->nullable()
                  ->after('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'phone',
                'otp',
                'otp_expired_at',
                'status',
                'mail_otp',
                'address',
                'state',
                'city'
            ]);
        });
    }
};