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
        // Check if the 'post_tag' table does not exist before creating it
        if (!Schema::hasTable('post_tag')) {
            Schema::create('post_tag', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id')->constrained()->onDelete('cascade');
                $table->foreignId('tag_id')->constrained()->onDelete('cascade');
                $table->unique(['post_id', 'tag_id']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'post_tag' table if it exists
        if (Schema::hasTable('post_tag')) {
            Schema::dropIfExists('post_tag');
        }
    }
};
