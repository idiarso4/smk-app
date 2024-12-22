<?php

namespace App\Filament\Resources\LibraryVisitResource\Pages;

use App\Filament\Resources\LibraryVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLibraryVisit extends ViewRecord
{
    protected static string $resource = LibraryVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 