<?php

namespace App\Exports;

use App\Models\StudentExpression;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentExpressionsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return StudentExpression::query()
            ->with(['student', 'reviewer']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Siswa',
            'Tipe',
            'Judul',
            'Kategori',
            'Tags',
            'Status',
            'Reviewer',
            'Tanggal Publikasi',
            'Featured',
            'Likes',
            'Comments',
            'Dibuat',
        ];
    }

    public function map($expression): array
    {
        return [
            $expression->id,
            $expression->student->name,
            $expression->type,
            $expression->title,
            $expression->category,
            implode(', ', $expression->tags),
            $expression->status,
            $expression->reviewer?->name,
            $expression->publish_date,
            $expression->is_featured ? 'Ya' : 'Tidak',
            $expression->likes_count,
            $expression->comments_count,
            $expression->created_at,
        ];
    }
} 