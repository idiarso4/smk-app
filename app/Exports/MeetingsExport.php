<?php

namespace App\Exports;

use App\Models\Meeting;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MeetingsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Meeting::query()
            ->with(['teacher', 'class']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Tipe',
            'Guru',
            'Kelas',
            'Waktu Mulai',
            'Waktu Selesai',
            'Lokasi',
            'Metode',
            'Status',
            'Dibuat',
        ];
    }

    public function map($meeting): array
    {
        return [
            $meeting->id,
            $meeting->title,
            $meeting->type,
            $meeting->teacher->name,
            $meeting->class->name,
            $meeting->start_time,
            $meeting->end_time,
            $meeting->location,
            $meeting->method,
            $meeting->status,
            $meeting->created_at,
        ];
    }
} 