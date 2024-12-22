<?php

namespace App\Exports;

use App\Models\ProductionUnit;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductionUnitsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return ProductionUnit::query()
            ->with(['supervisor']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Unit',
            'Kategori',
            'Penanggung Jawab',
            'Lokasi',
            'Jam Operasional',
            'Hari Operasional',
            'Status',
            'Dibuat',
        ];
    }

    public function map($unit): array
    {
        return [
            $unit->id,
            $unit->name,
            $unit->category,
            $unit->supervisor->name,
            $unit->location,
            $unit->open_time . ' - ' . $unit->close_time,
            implode(', ', $unit->operational_days),
            $unit->is_active ? 'Aktif' : 'Nonaktif',
            $unit->created_at,
        ];
    }
} 