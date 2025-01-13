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
        // Check if the table 'posts' does not exist before creating it
        if (! Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id(); // Auto-increment primary key
                $table->string('title'); // Title of the post
                $table->text('description'); // Short description of the post
                $table->string('slug')->unique(); // Unique slug for the post
                $table->longText('content'); // Main content of the post
                $table->timestamps(); // Created and updated timestamps
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'posts' table if it exists
        Schema::dropIfExists('posts');
    }
};
