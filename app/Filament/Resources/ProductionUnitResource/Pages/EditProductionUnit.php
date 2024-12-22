<?php

namespace App\Filament\Resources\ProductionUnitResource\Pages;

use App\Filament\Resources\ProductionUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductionUnit extends EditRecord
{
    protected static string $resource = ProductionUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 