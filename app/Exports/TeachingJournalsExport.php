<?php

namespace App\Exports;

use App\Models\TeachingJournal;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeachingJournalsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return TeachingJournal::query()
            ->with(['teacher', 'class', 'subject']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Guru',
            'Kelas',
            'Mata Pelajaran',
            'Tanggal',
            'Waktu Mulai',
            'Waktu Selesai',
            'Topik',
            'Metode',
            'Tujuan Pembelajaran',
            'Kegiatan',
            'Media',
            'Tugas',
            'Jumlah Siswa',
            'Dibuat',
        ];
    }

    public function map($journal): array
    {
        return [
            $journal->id,
            $journal->teacher->name,
            $journal->class->name,
            $journal->subject->name,
            $journal->date,
            $journal->start_time,
            $journal->end_time,
            $journal->topic,
            $journal->teaching_method,
            $journal->learning_objectives,
            $journal->learning_activities,
            implode(', ', $journal->learning_media ?? []),
            $journal->homework,
            $journal->student_attendance_count,
            $journal->created_at,
        ];
    }
} 