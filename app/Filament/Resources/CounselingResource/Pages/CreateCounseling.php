<?php

namespace App\Filament\Resources\CounselingResource\Pages;

use App\Filament\Resources\CounselingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCounseling extends CreateRecord
{
    protected static string $resource = CounselingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'scheduled';
        
        return $data;
    }
} 