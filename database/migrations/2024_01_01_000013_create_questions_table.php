<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained()->cascadeOnDelete();
            $table->enum('question_type', [
                'multiple_choice',
                'essay',
                'true_false',
                'matching',
                'short_answer'
            ]);
            $table->text('question_text');
            $table->json('attachments')->nullable(); // gambar, audio, atau video
            $table->integer('points')->default(1);
            
            // Untuk pilihan ganda
            $table->json('choices')->nullable();
            
            // Untuk benar/salah
            $table->boolean('correct_answer_boolean')->nullable();
            
            // Untuk essay dan jawaban singkat
            $table->text('answer_key')->nullable();
            
            // Untuk menjodohkan
            $table->json('matching_pairs')->nullable();
            
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('medium');
            $table->text('explanation')->nullable(); // penjelasan jawaban
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
}; 