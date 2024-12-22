<?php

namespace App\Filament\Resources\StudentOrganizationResource\Pages;

use App\Filament\Resources\StudentOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentOrganization extends ViewRecord
{
    protected static string $resource = StudentOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 