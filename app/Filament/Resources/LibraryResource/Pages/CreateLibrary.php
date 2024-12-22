<?php

namespace App\Filament\Resources\LibraryResource\Pages;

use App\Filament\Resources\LibraryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLibrary extends CreateRecord
{
    protected static string $resource = LibraryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'available';
        
        return $data;
    }
} 