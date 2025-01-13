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
        // Check if the table 'comments' does not exist before creating it
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id(); // Auto-increment primary key
                $table->text('body'); // Comment body
                $table->foreignId('post_id') // Foreign key to posts table
                    ->constrained() // Creates the foreign key constraint
                    ->onDelete('cascade'); // Cascade on delete
                $table->timestamps(); // Created and updated timestamps
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'comments' table if it exists
        Schema::dropIfExists('comments');
    }
};
