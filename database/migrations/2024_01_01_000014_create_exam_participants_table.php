<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'abandoned'])
                  ->default('not_started');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Satu siswa hanya bisa mengikuti satu ujian sekali
            $table->unique(['exam_id', 'student_id']);
        });

        // Tabel untuk menyimpan jawaban siswa
        Schema::create('exam_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_participant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->text('answer')->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();

            // Satu siswa hanya bisa menjawab satu soal sekali
            $table->unique(['exam_participant_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_answers');
        Schema::dropIfExists('exam_participants');
    }
}; 