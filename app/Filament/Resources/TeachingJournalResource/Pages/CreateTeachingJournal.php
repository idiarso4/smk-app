<?php

namespace App\Filament\Resources\TeachingJournalResource\Pages;

use App\Filament\Resources\TeachingJournalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTeachingJournal extends CreateRecord
{
    protected static string $resource = TeachingJournalResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika ada data yang perlu dimutasi sebelum create
        return $data;
    }
} 