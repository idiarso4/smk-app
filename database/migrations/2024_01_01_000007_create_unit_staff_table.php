<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_unit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('staff_id')->constrained('users')->cascadeOnDelete();
            $table->enum('role', ['manager', 'supervisor', 'cashier', 'operator', 'helper']);
            $table->enum('shift', ['morning', 'afternoon', 'evening', 'full']);
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_staff');
    }
}; 