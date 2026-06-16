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
    Schema::create('business_types', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('vendor_type_id'); 
        $table->string('business_name');
        $table->tinyInteger('status')->default(1);
        $table->timestamps();

        $table->foreign('vendor_type_id')
              ->references('id')
              ->on('vendor_types')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_types');
    }
};
