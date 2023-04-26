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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->required();
            $table->string('slug')->unique()->nullable();;
            $table->text('description');
            $table->decimal('price', 6, 2);
            $table->string('isbn')->required();
            $table->integer('pages')->nullable();
            $table->string('image');
            $table->integer('stock')->required();
            $table->foreignId('editorial_id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
