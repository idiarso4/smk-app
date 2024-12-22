<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_unit_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_number')->unique();
            $table->enum('customer_type', ['student', 'teacher', 'staff', 'guest']);
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('staff_id')->constrained('unit_staff')->cascadeOnDelete();
            $table->dateTime('transaction_date');
            $table->enum('payment_method', ['cash', 'transfer', 'qris', 'other']);
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['pending', 'paid', 'cancelled']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}; 