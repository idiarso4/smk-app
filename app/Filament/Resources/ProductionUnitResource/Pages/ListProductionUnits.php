<?php

namespace App\Filament\Resources\ProductionUnitResource\Pages;

use App\Filament\Resources\ProductionUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;
use App\Exports\ProductionUnitsExport;

class ListProductionUnits extends ListRecords
{
    protected static string $resource = ProductionUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->label('Export Excel')
                ->exports([
                    ProductionUnitsExport::class
                ]),
        ];
    }
} 