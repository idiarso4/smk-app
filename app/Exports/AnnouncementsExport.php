<?php

namespace App\Exports;

use App\Models\Announcement;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnnouncementsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Announcement::query()
            ->with(['author', 'approver']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Tipe',
            'Penulis',
            'Target',
            'Tanggal Publikasi',
            'Tanggal Berakhir',
            'Featured',
            'Urgent',
            'Status',
            'Disetujui Oleh',
            'Dibuat',
        ];
    }

    public function map($announcement): array
    {
        return [
            $announcement->id,
            $announcement->title,
            $announcement->type,
            $announcement->author->name,
            implode(', ', $announcement->target_audience),
            $announcement->publish_date,
            $announcement->end_date,
            $announcement->is_featured ? 'Ya' : 'Tidak',
            $announcement->is_urgent ? 'Ya' : 'Tidak',
            $announcement->status,
            $announcement->approver?->name,
            $announcement->created_at,
        ];
    }
} 