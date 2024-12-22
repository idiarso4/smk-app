<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['canteen', 'store', 'service', 'workshop', 'other']);
            $table->foreignId('supervisor_id')->nullable()->constrained('teachers')->nullOnDelete();
            $table->string('location');
            $table->time('open_time');
            $table->time('close_time');
            $table->json('operational_days');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('photos')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_units');
    }
}; 