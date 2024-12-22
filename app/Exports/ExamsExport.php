<?php

namespace App\Exports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExamsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Exam::query()
            ->with(['subject', 'teacher', 'classes']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul Ujian',
            'Jenis',
            'Mata Pelajaran',
            'Guru',
            'Kelas',
            'Waktu Mulai',
            'Waktu Selesai',
            'Durasi',
            'KKM',
            'Status',
            'Jumlah Soal',
            'Jumlah Peserta',
            'Dibuat',
        ];
    }

    public function map($exam): array
    {
        return [
            $exam->id,
            $exam->title,
            $exam->exam_type,
            $exam->subject->name,
            $exam->teacher->name,
            $exam->classes->pluck('name')->implode(', '),
            $exam->start_time,
            $exam->end_time,
            $exam->duration . ' menit',
            $exam->passing_grade,
            $exam->is_active ? 'Aktif' : 'Nonaktif',
            $exam->questions_count,
            $exam->participants_count,
            $exam->created_at,
        ];
    }
} 