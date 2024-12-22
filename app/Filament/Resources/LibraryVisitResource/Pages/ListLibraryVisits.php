<?php

namespace App\Filament\Resources\LibraryVisitResource\Pages;

use App\Filament\Resources\LibraryVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;
use App\Exports\LibraryVisitsExport;

class ListLibraryVisits extends ListRecords
{
    protected static string $resource = LibraryVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->label('Export Excel')
                ->exports([
                    LibraryVisitsExport::class
                ]),
        ];
    }
} 