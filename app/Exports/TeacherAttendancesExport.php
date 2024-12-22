<?php

namespace App\Exports;

use App\Models\TeacherAttendance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TeacherAttendancesExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return TeacherAttendance::query()
            ->with(['teacher', 'class', 'subject']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Guru',
            'Kelas',
            'Mata Pelajaran',
            'Waktu Masuk',
            'Waktu Keluar',
            'Status',
            'Catatan',
            'Dibuat',
        ];
    }

    public function map($attendance): array
    {
        return [
            $attendance->id,
            $attendance->teacher->name,
            $attendance->class->name,
            $attendance->subject->name,
            $attendance->check_in,
            $attendance->check_out,
            $attendance->status,
            $attendance->notes,
            $attendance->created_at,
        ];
    }
} 