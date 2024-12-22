<?php

namespace App\Filament\Resources\ProductionUnitResource\Pages;

use App\Filament\Resources\ProductionUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductionUnit extends ViewRecord
{
    protected static string $resource = ProductionUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 