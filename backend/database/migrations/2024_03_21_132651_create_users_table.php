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
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('surname');
            $table->string('lastname')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->text('discription')->nullable();

            $table->foreignId('specialization_id')->constrained('specializations');
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete()->noActionOnUpdate();
            $table->foreignId('position_id')->constrained('positions');

            $table->string('state')->default('created');
            $table->string('password');
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
