<?php

namespace App\Filament\Resources\LibraryVisitResource\Pages;

use App\Filament\Resources\LibraryVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLibraryVisit extends EditRecord
{
    protected static string $resource = LibraryVisitResource::class;

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