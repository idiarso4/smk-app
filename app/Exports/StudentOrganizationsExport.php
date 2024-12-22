<?php

namespace App\Exports;

use App\Models\StudentOrganization;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentOrganizationsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return StudentOrganization::query()
            ->with(['advisor']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Kode',
            'Tipe',
            'Pembina',
            'Periode Mulai',
            'Periode Selesai',
            'Status',
            'Dibuat',
        ];
    }

    public function map($organization): array
    {
        return [
            $organization->id,
            $organization->name,
            $organization->code,
            $organization->type,
            $organization->advisor->name,
            $organization->period_start,
            $organization->period_end,
            $organization->status ? 'Aktif' : 'Tidak Aktif',
            $organization->created_at,
        ];
    }
} 