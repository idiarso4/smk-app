<?php

namespace App\Exports;

use App\Models\PrayerAttendance;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PrayerAttendancesExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return PrayerAttendance::query()
            ->with(['student', 'class', 'supervisor']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Siswa',
            'Kelas',
            'Tanggal',
            'Shalat',
            'Waktu Absen',
            'Lokasi',
            'Status',
            'Pembimbing',
            'Catatan',
            'Dibuat',
        ];
    }

    public function map($attendance): array
    {
        return [
            $attendance->id,
            $attendance->student->name,
            $attendance->class->name,
            $attendance->date,
            $attendance->prayer,
            $attendance->check_in,
            $attendance->location,
            $attendance->status,
            $attendance->supervisor?->name,
            $attendance->notes,
            $attendance->created_at,
        ];
    }
} 