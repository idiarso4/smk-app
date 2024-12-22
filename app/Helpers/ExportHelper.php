<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class ExportHelper
{
    public static function toExcel($data, $headings, $fileName)
    {
        $export = new class($data, $headings) implements FromCollection, WithHeadings {
            private $data;
            private $headings;

            public function __construct($data, $headings)
            {
                $this->data = $data;
                $this->headings = $headings;
            }

            public function collection()
            {
                return new Collection($this->data);
            }

            public function headings(): array
            {
                return $this->headings;
            }
        };

        return Excel::download($export, $fileName);
    }

    public static function formatDate($date)
    {
        return $date ? date('d/m/Y', strtotime($date)) : '-';
    }

    public static function formatDateTime($datetime)
    {
        return $datetime ? date('d/m/Y H:i', strtotime($datetime)) : '-';
    }

    public static function formatCurrency($amount)
    {
        return number_format($amount, 0, ',', '.');
    }
} 