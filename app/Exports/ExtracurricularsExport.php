<?php

namespace App\Exports;

use App\Models\Extracurricular;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExtracurricularsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Extracurricular::query()
            ->with(['coach', 'assistantCoach']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Kode',
            'Kategori',
            'Pembina',
            'Asisten Pembina',
            'Lokasi',
            'Hari',
            'Waktu Mulai',
            'Waktu Selesai',
            'Kuota',
            'Poin',
            'Status',
            'Jumlah Anggota',
            'Dibuat',
        ];
    }

    public function map($extracurricular): array
    {
        return [
            $extracurricular->id,
            $extracurricular->name,
            $extracurricular->code,
            $extracurricular->category,
            $extracurricular->coach->name,
            $extracurricular->assistantCoach?->name,
            $extracurricular->location,
            $extracurricular->schedule_day,
            $extracurricular->start_time,
            $extracurricular->end_time,
            $extracurricular->quota,
            $extracurricular->points,
            $extracurricular->is_active ? 'Aktif' : 'Tidak Aktif',
            $extracurricular->members_count,
            $extracurricular->created_at,
        ];
    }
} 