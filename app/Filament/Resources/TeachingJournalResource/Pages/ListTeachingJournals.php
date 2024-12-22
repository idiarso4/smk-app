<?php

namespace App\Filament\Resources\TeachingJournalResource\Pages;

use App\Filament\Resources\TeachingJournalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;
use App\Exports\TeachingJournalsExport;

class ListTeachingJournals extends ListRecords
{
    protected static string $resource = TeachingJournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->label('Export Excel')
                ->exports([
                    TeachingJournalsExport::class
                ]),
        ];
    }
} 