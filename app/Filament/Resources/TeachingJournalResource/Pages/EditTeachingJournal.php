<?php

namespace App\Filament\Resources\TeachingJournalResource\Pages;

use App\Filament\Resources\TeachingJournalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeachingJournal extends EditRecord
{
    protected static string $resource = TeachingJournalResource::class;

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