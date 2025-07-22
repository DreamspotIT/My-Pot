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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();                 // Gold or Silver
            $table->decimal('rate_per_gram', 10, 2)->nullable(); // e.g. 6725.50
            $table->date('rate_date')->nullable();           // e.g. 2025-07-22
            $table->timestamps();                            // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
