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
        Schema::create('posts_photos', function (Blueprint $table) {
            $table->id();
            $table->string('photo_name');
            $table->string('state');
            $table->foreignId('post_id')->constrained('posts');
            $table->string('after_word');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_photos');
    }
};
