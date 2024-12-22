<?php

namespace App\Exports;

use App\Models\Library;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LibrariesExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Library::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'ISBN',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'Kategori',
            'Edisi',
            'Halaman',
            'Lokasi Rak',
            'Jumlah Copy',
            'Status',
            'Bahasa',
            'Dipinjam',
            'Dibuat',
        ];
    }

    public function map($library): array
    {
        return [
            $library->id,
            $library->title,
            $library->isbn,
            $library->author,
            $library->publisher,
            $library->publish_year,
            $library->category,
            $library->edition,
            $library->pages,
            $library->rack_location,
            $library->copies,
            $library->status,
            $library->language,
            $library->borrowed_count,
            $library->created_at,
        ];
    }
} 