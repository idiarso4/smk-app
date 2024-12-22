<?php

namespace App\Filament\Resources\ProductionUnitResource\Pages;

use App\Filament\Resources\ProductionUnitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductionUnit extends CreateRecord
{
    protected static string $resource = ProductionUnitResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['is_active'] = true;
        
        return $data;
    }
} 