<?php

namespace App\Filament\Resources\StudentOrganizationResource\Pages;

use App\Filament\Resources\StudentOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentOrganization extends EditRecord
{
    protected static string $resource = StudentOrganizationResource::class;

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