<?php

namespace App\Filament\Resources\TeachingJournalResource\Pages;

use App\Filament\Resources\TeachingJournalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTeachingJournal extends ViewRecord
{
    protected static string $resource = TeachingJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 