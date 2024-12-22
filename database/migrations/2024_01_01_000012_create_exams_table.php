<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('exam_type', ['uts', 'uas', 'quiz', 'daily', 'practice', 'other']);
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('duration'); // in minutes
            $table->integer('passing_grade');
            $table->boolean('randomize_questions')->default(false);
            $table->boolean('show_result')->default(true);
            $table->boolean('is_active')->default(true);
            $table->text('instructions')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('exam_classes', function (Blueprint $table) {
            $table->foreignId('exam_id')->constrained()->cascadeOnDelete();
            $table->foreignId('class_room_id')->constrained()->cascadeOnDelete();
            $table->primary(['exam_id', 'class_room_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_classes');
        Schema::dropIfExists('exams');
    }
}; 