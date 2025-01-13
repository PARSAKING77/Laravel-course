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
        // Check if the table 'pages' does not exist before creating it
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id(); // Auto-increment primary key
                $table->string('title'); // Title of the page
                $table->string('slug')->unique(); // Unique slug for the page
                $table->longText('content'); // Content of the page
                $table->timestamps(); // Created and updated timestamps
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'pages' table if it exists
        Schema::dropIfExists('pages');
    }
};
