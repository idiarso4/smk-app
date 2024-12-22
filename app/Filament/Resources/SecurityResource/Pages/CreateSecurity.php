<?php

namespace App\Filament\Resources\SecurityResource\Pages;

use App\Filament\Resources\SecurityResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSecurity extends CreateRecord
{
    protected static string $resource = SecurityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'reported';
        
        return $data;
    }
} 