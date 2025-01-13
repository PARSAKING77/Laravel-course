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
            // Add 'mobile' column only if it does not exist
            if (!Schema::hasColumn('users', 'mobile')) {
                $table->char('mobile')->nullable();
            }

            // Add 'is_verified_mobile' column only if it does not exist
            if (!Schema::hasColumn('users', 'is_verified_mobile')) {
                $table->boolean('is_verified_mobile')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop 'mobile' column only if it exists
            if (Schema::hasColumn('users', 'mobile')) {
                $table->dropColumn('mobile');
            }

            // Drop 'is_verified_mobile' column only if it exists
            if (Schema::hasColumn('users', 'is_verified_mobile')) {
                $table->dropColumn('is_verified_mobile');
            }
        });
    }
};
