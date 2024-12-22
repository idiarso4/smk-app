<?php

namespace App\Exports;

use App\Models\BookLoan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookLoansExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return BookLoan::query()
            ->with(['student', 'book', 'librarian']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Siswa',
            'Kelas',
            'Buku',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Tanggal Dikembalikan',
            'Denda',
            'Status',
            'Petugas',
            'Catatan',
            'Dibuat',
        ];
    }

    public function map($loan): array
    {
        return [
            $loan->id,
            $loan->student->name,
            $loan->student->class->name,
            $loan->book->title,
            $loan->loan_date,
            $loan->due_date,
            $loan->return_date,
            $loan->fine_amount,
            $loan->status,
            $loan->librarian->name,
            $loan->notes,
            $loan->created_at,
        ];
    }
} 