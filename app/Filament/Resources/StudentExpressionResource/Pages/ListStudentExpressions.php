<?php

namespace App\Filament\Resources\StudentExpressionResource\Pages;

use App\Filament\Resources\StudentExpressionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;
use App\Exports\StudentExpressionsExport;

class ListStudentExpressions extends ListRecords
{
    protected static string $resource = StudentExpressionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->label('Export Excel')
                ->exports([
                    StudentExpressionsExport::class
                ]),
        ];
    }
} 