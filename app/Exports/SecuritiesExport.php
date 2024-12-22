<?php

namespace App\Exports;

use App\Models\Security;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SecuritiesExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Security::query()
            ->with(['student', 'reporter', 'handler']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Siswa',
            'Tipe',
            'Tanggal Kejadian',
            'Lokasi',
            'Dilaporkan Oleh',
            'Ditangani Oleh',
            'Poin',
            'Status',
            'Tindakan',
            'Orang Tua Diberitahu',
            'Dibuat',
        ];
    }

    public function map($security): array
    {
        return [
            $security->id,
            $security->student->name,
            $security->type,
            $security->incident_date,
            $security->location,
            $security->reporter->name,
            $security->handler?->name,
            $security->points,
            $security->status,
            $security->action_taken,
            $security->parent_notified ? 'Ya' : 'Tidak',
            $security->created_at,
        ];
    }
} 