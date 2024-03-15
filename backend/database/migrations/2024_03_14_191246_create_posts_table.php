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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('post_title');
            $table->string('post_discription')->nullable();
            $table->text('post_text');

            $table->boolean('active')->default(true);

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('post_type_id')->unsigned();
            $table->foreign('post_type_id')->references('id')->on('post_types');

            $table->string('post_photo')->nullable();

            $table->boolean('published')->default(true);
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
