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
        Schema::table('vendors', function (Blueprint $table) {

            $table->unsignedBigInteger('category_id')
                  ->after('business_id');

            $table->unsignedBigInteger('sub_category_id')
                  ->nullable()
                  ->after('category_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {

            $table->dropColumn([
                'category_id',
                'sub_category_id'
            ]);

        });
    }
};