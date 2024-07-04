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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->nullable(true)->default(null)->unique();
            $table->string('username', 255)->unique();
            $table->string('full_name', 255);
            $table->string('password', 255);
            $table->string('email', 255)->unique();
            $table->enum('gender', ['male', 'female', '-'])->default('male');
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
