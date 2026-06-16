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
        //
        Schema::table('real_estates', function (Blueprint $table) {

            // 1. Fix typo column name
            if (Schema::hasColumn('real_estates', 'descripction')) {
                $table->renameColumn('descripction', 'description');
            }

            // 2. Add documents column
            if (!Schema::hasColumn('real_estates', 'documents')) {
                $table->json('documents')->nullable()->after('datasheet');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('real_estates', function (Blueprint $table) {

            // rollback documents
            if (Schema::hasColumn('real_estates', 'documents')) {
                $table->dropColumn('documents');
            }

            // revert rename
            if (Schema::hasColumn('real_estates', 'description')) {
                $table->renameColumn('description', 'descripction');
            }
        });
    }
};
