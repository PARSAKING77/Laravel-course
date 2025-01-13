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
        Schema::table('comments', function (Blueprint $table) {
            // Check if the 'post_id' column exists
            if (Schema::hasColumn('comments', 'post_id')) {
                // Drop the foreign key if it exists
                if ($this->foreignKeyExists('comments', 'comments_post_id_foreign')) {
                    $table->dropForeign(['post_id']);
                }
                $table->dropColumn('post_id');
            }

            // Add polymorphic columns if they don't exist
            if (!Schema::hasColumn('comments', 'commentable_type')) {
                $table->string('commentable_type');
            }
            if (!Schema::hasColumn('comments', 'commentable_id')) {
                $table->unsignedBigInteger('commentable_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            if (Schema::hasColumn('comments', 'commentable_type')) {
                $table->dropColumn('commentable_type');
            }
            if (Schema::hasColumn('comments', 'commentable_id')) {
                $table->dropColumn('commentable_id');
            }

            // Recreate the 'post_id' column and foreign key if necessary
            if (!Schema::hasColumn('comments', 'post_id')) {
                $table->foreignId('post_id')->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Helper function to check if a foreign key exists.
     */
    private function foreignKeyExists($table, $foreignKeyName): bool
    {
        return \DB::table('information_schema.table_constraints')
                ->where('table_name', $table)
                ->where('constraint_name', $foreignKeyName)
                ->exists();
    }
};
