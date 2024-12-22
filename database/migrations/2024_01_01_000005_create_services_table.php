<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_unit_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('category', ['service', 'repair', 'maintenance', 'rental', 'consultation', 'other']);
            $table->decimal('price', 12, 2);
            $table->integer('duration')->nullable(); // in minutes
            $table->text('description')->nullable();
            $table->boolean('is_available')->default(true);
            $table->json('photos')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
}; 