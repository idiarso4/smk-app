<?php

namespace App\Exports;

use App\Models\Permit;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PermitsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Permit::query()
            ->with(['student', 'subject', 'teacher', 'supervisor']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal',
            'Siswa',
            'Mata Pelajaran',
            'Guru Mapel',
            'Guru Piket',
            'Jenis',
            'Mulai',
            'Selesai',
            'Alasan',
            'Status',
            'Dibuat',
        ];
    }

    public function map($permit): array
    {
        return [
            $permit->id,
            $permit->permit_date,
            $permit->student->name,
            $permit->subject->name,
            $permit->teacher->name,
            $permit->supervisor->name,
            $permit->type,
            $permit->start_time,
            $permit->end_time,
            $permit->reason,
            $permit->status,
            $permit->created_at,
        ];
    }
} 