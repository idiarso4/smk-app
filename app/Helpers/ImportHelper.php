<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

class ImportHelper implements ToCollection, WithHeadingRow
{
    private $callback;

    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    public function collection(Collection $rows)
    {
        $callback = $this->callback;
        $callback($rows);
    }

    public static function fromExcel($file, $callback)
    {
        return Excel::import(new self($callback), $file);
    }

    public static function validateRequired($row, $fields)
    {
        foreach ($fields as $field) {
            if (empty($row[$field])) {
                throw new \Exception("Field {$field} is required");
            }
        }
    }

    public static function cleanDate($date)
    {
        if (!$date) return null;
        return date('Y-m-d', strtotime($date));
    }

    public static function cleanDateTime($datetime)
    {
        if (!$datetime) return null;
        return date('Y-m-d H:i:s', strtotime($datetime));
    }
} 