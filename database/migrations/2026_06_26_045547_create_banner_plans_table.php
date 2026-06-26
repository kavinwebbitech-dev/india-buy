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
        Schema::create('banner_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->decimal('price', 10, 2);
            $table->integer('duration'); // Days
            $table->integer('max_banners')->default(1);
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_plans');
    }
};
