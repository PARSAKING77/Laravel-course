<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename the table from 'post_tag' to 'taggables'
        Schema::rename('post_tag', 'taggables');

        Schema::table('taggables', function (Blueprint $table) {
            // Drop the foreign key before dropping the 'post_id' column
            if (Schema::hasColumn('taggables', 'post_id')) {
                // Get the actual foreign key name using a raw query
                $foreignKeyName = $this->getForeignKeyName('taggables', 'post_id');
                
                // Only drop the foreign key if it exists
                if ($foreignKeyName) {
                    // Drop the foreign key constraint if it exists
                    $table->dropForeign([$foreignKeyName]);
                }

                // Drop the 'post_id' column
                $table->dropColumn('post_id');
            }

            // Add polymorphic relationship columns
            $table->morphs('taggable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taggables', function (Blueprint $table) {
            // Remove the polymorphic columns
            $table->dropMorphs('taggable');

            // Add back the 'post_id' column with a foreign key if it doesn't exist
            if (!Schema::hasColumn('taggables', 'post_id')) {
                $table->foreignId('post_id')->constrained()->onDelete('cascade');
            }
        });

        // Rename the table back to 'post_tag'
        Schema::rename('taggables', 'post_tag');
    }

    /**
     * Get the foreign key name for a given column.
     */
    private function getForeignKeyName(string $table, string $column): ?string
    {
        // Query the information schema to get the foreign key name for the column
        $result = DB::select(
            "SELECT CONSTRAINT_NAME
             FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
             WHERE TABLE_NAME = ? AND COLUMN_NAME = ?",
            [$table, $column]
        );

        // If a foreign key exists, return its name
        return $result ? $result[0]->CONSTRAINT_NAME : null;
    }
};
