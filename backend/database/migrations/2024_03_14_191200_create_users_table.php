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
            $table->rememberToken();

            $table->string('name');
            $table->string('surname');
            $table->string('lastname')->nullable();
            $table->string('discription')->nullable();

            $table->string('email')->unique();
            $table->string('profile_pic')->nullable();

            $table->boolean('active')->default(true);
            $table->boolean('admin')->default(false);

            $table->bigInteger('specialization_id')->unsigned();
            $table->foreign('specialization_id')->references('id')->on('specializations');

            $table->bigInteger('faculty_id')->unsigned();
            $table->foreign('faculty_id')->references('id')->on('faculties');

            $table->bigInteger('position_id')->unsigned();
            $table->foreign('position_id')->references('id')->on('positions');

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
