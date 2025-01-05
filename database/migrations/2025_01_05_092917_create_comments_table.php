<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        if (!Schema::hasTable('pages')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->text("body");
                $table->foreignId("post_id")->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }
    
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};