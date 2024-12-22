<?php

namespace App\Exports;

use App\Models\Achievement;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AchievementsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Achievement::query()
            ->with(['student', 'coach', 'team']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Siswa',
            'Judul',
            'Kategori',
            'Level',
            'Nama Lomba',
            'Penyelenggara',
            'Tanggal',
            'Peringkat',
            'Pembimbing',
            'Poin',
            'Dibuat',
        ];
    }

    public function map($achievement): array
    {
        return [
            $achievement->id,
            $achievement->student->name,
            $achievement->title,
            $achievement->category,
            $achievement->level,
            $achievement->competition_name,
            $achievement->organizer,
            $achievement->achievement_date,
            $achievement->rank,
            $achievement->coach?->name,
            $achievement->points,
            $achievement->created_at,
        ];
    }
} 