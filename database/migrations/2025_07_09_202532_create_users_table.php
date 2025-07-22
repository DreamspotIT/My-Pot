<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('firstname', 100);
            $table->string('middlename', 100)->nullable();
            $table->string('lastname', 100);

            $table->string('email', 100)->nullable()->unique();
            $table->string('phone', 15)->unique();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('password', 255)->nullable();
            $table->string('original_password')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('role')->default('user');
            $table->dateTime('createdAt')->useCurrent();
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->dateTime('updatedAt')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedBigInteger('updatedBy')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
