// database/migrations/2024_09_09_171929_rename_post_tag_table_to_taggables.php
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
        // Check if the 'taggables' table already exists to avoid the error
        if (!Schema::hasTable('taggables')) {
            // Rename the 'post_tag' table to 'taggables'
            Schema::rename("post_tag", "taggables");

            // Modify the 'taggables' table
            Schema::table('taggables', function (Blueprint $table) {
                // Drop the old column and foreign key for 'post_id'
                if (Schema::hasColumn('taggables', 'post_id')) {
                    $table->dropForeign('post_tag_post_id_foreign'); // Drop the foreign key
                    $table->dropColumn('post_id'); // Drop the 'post_id' column
                }

                // Add polymorphic fields for the relationship
                $table->morphs('taggable'); // Adds `taggable_id` (unsignedBigInteger) and `taggable_type` (string)

                // Add the foreign key for 'tag_id' if it's not already there
                if (!Schema::hasColumn('taggables', 'tag_id')) {
                    $table->foreignId('tag_id')->constrained()->onDelete('cascade');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Modify the 'taggables' table to reverse changes
        Schema::table('taggables', function (Blueprint $table) {
            $table->dropMorphs('taggable'); // Drop the polymorphic columns
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Add 'post_id' back with foreign key
        });

        // Rename the 'taggables' table back to 'post_tag'
        Schema::rename('taggables', 'post_tag');
    }
};
