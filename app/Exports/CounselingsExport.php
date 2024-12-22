<?php

namespace App\Exports;

use App\Models\Counseling;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CounselingsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Counseling::query()
            ->with(['student', 'counselor']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Siswa',
            'Konselor',
            'Tipe',
            'Tanggal Sesi',
            'Lokasi',
            'Metode',
            'Status',
            'Rahasia',
            'Melibatkan Ortu',
            'Dibuat',
        ];
    }

    public function map($counseling): array
    {
        return [
            $counseling->id,
            $counseling->student->name,
            $counseling->counselor->name,
            $counseling->type,
            $counseling->session_date,
            $counseling->location,
            $counseling->method,
            $counseling->status,
            $counseling->is_confidential ? 'Ya' : 'Tidak',
            $counseling->parent_involved ? 'Ya' : 'Tidak',
            $counseling->created_at,
        ];
    }
} 