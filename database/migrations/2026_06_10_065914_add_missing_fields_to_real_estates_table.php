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
        Schema::table('real_estates', function (Blueprint $table) {
            //
            // Add the image and document text/json columns if missing

            // Add the optional structural fields if you don't have them yet
            $table->string('price')->nullable()->after('landmark');
            $table->string('total_area')->nullable()->after('price');
            $table->string('built_up_area')->nullable()->after('total_area');
            $table->string('carpet_area')->nullable()->after('built_up_area');
            $table->string('project_status')->nullable()->after('carpet_area');
            $table->string('construction_type')->nullable()->after('project_status');
            $table->string('floors')->nullable()->after('construction_type');
            $table->string('units')->nullable()->after('floors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('real_estates', function (Blueprint $table) {
            //
            $table->dropColumn([
                'property_image', 'documents', 'price', 'total_area', 
                'built_up_area', 'carpet_area', 'project_status', 
                'construction_type', 'floors', 'units'
            ]);
        });
    }
};
