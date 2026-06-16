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
    Schema::create('categories', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('vendor_type_id');
        $table->unsignedBigInteger('business_type_id');

        $table->string('category_name');
        $table->string('image')->nullable(); // ✅ ADDED IMAGE
        $table->tinyInteger('status')->default(1);

        $table->timestamps();

        // 🔗 Relations
        $table->foreign('vendor_type_id')
              ->references('id')->on('vendor_types')
              ->onDelete('cascade');

        $table->foreign('business_type_id')
              ->references('id')->on('business_types')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
