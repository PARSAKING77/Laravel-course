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

            if (!Schema::hasColumn('users', 'mobile')) {
                $table->char('mobile')->nullable();
            }

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
            // Drop the 'mobile' column if it exists
            if (Schema::hasColumn('users', 'mobile')) {
                $table->dropColumn('mobile');
            }

            if (Schema::hasColumn('users', 'is_verified_mobile')) {
                $table->dropColumn('is_verified_mobile');
            }
        });
    }
};
