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
        // Check if the table 'post_tag' does not exist before creating it
        if (!Schema::hasTable('post_tag')) {
            Schema::create('post_tag', function (Blueprint $table) {
                $table->id(); // Auto-increment primary key
                $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Foreign key to posts table
                $table->foreignId('tag_id')->constrained()->onDelete('cascade'); // Foreign key to tags table
                $table->unique(['post_id', 'tag_id']); // Unique constraint for post_id and tag_id combination
                $table->timestamps(); // Created and updated timestamps
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'post_tag' table if it exists
        Schema::dropIfExists('post_tag');
    }
};
