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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')
            ->constrained('vendors')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            // Banner Plan Relation
            $table->foreignId('plan_id')
                ->constrained('banner_plans')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('redirect_url')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected',
                'Expired'
            ])->default('Pending');

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
