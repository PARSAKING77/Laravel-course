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
        // Check if the table 'tags' does not exist before creating it
        if (!Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->id(); // Auto-increment primary key
                $table->string('name')->unique(); // Unique name for the tag
                $table->timestamps(); // Created and updated timestamps
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'tags' table if it exists
        Schema::dropIfExists('tags');
    }
};
