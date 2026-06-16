<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {

            $table->id();

            // 🔗 Relations
            $table->unsignedBigInteger('business_type_id');
            $table->unsignedBigInteger('category_id');

            // 📌 Fields
            $table->string('sub_category_name');
            $table->tinyInteger('status')->default(1);

            $table->timestamps();

            // 🔗 Foreign Keys
            $table->foreign('business_type_id')
                  ->references('id')
                  ->on('business_types')
                  ->onDelete('cascade');

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};