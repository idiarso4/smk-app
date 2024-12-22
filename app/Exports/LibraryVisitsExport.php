<?php

namespace App\Exports;

use App\Models\LibraryVisit;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LibraryVisitsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return LibraryVisit::query()
            ->with(['student']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Siswa',
            'Waktu Masuk',
            'Waktu Keluar',
            'Tujuan',
            'Durasi',
            'Catatan',
            'Dibuat',
        ];
    }

    public function map($visit): array
    {
        $duration = '-';
        if ($visit->check_out) {
            $minutes = $visit->check_out->diffInMinutes($visit->check_in);
            $duration = floor($minutes / 60) . ' jam ' . ($minutes % 60) . ' menit';
        }

        return [
            $visit->id,
            $visit->student->name,
            $visit->check_in,
            $visit->check_out,
            $visit->purpose,
            $duration,
            $visit->notes,
            $visit->created_at,
        ];
    }
} 