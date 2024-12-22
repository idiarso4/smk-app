<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn')->unique();
            $table->string('author');
            $table->string('publisher');
            $table->enum('category', ['fiction', 'non-fiction', 'textbook', 'reference', 'magazine', 'other']);
            $table->integer('publication_year');
            $table->string('edition')->nullable();
            $table->integer('pages')->nullable();
            $table->integer('stock')->default(1);
            $table->string('shelf_location');
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->boolean('is_available')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
}; 