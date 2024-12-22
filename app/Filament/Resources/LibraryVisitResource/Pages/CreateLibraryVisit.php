<?php

namespace App\Filament\Resources\LibraryVisitResource\Pages;

use App\Filament\Resources\LibraryVisitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLibraryVisit extends CreateRecord
{
    protected static string $resource = LibraryVisitResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['check_in'] = now();
        
        return $data;
    }
} 