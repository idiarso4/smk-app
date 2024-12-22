<?php

namespace App\Exports;

use App\Models\GuestBook;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GuestBooksExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return GuestBook::query()
            ->with(['staff']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Institusi',
            'No. Telepon',
            'Email',
            'Tujuan',
            'Bertemu',
            'Waktu Masuk',
            'Waktu Keluar',
            'Status',
            'Dibuat',
        ];
    }

    public function map($guestBook): array
    {
        return [
            $guestBook->id,
            $guestBook->name,
            $guestBook->institution,
            $guestBook->phone,
            $guestBook->email,
            $guestBook->purpose,
            $guestBook->staff?->name,
            $guestBook->check_in,
            $guestBook->check_out,
            $guestBook->status,
            $guestBook->created_at,
        ];
    }
} 