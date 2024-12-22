<?php

namespace App\Filament\Resources\StudentOrganizationResource\Pages;

use App\Filament\Resources\StudentOrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;
use App\Exports\StudentOrganizationsExport;

class ListStudentOrganizations extends ListRecords
{
    protected static string $resource = StudentOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->label('Export Excel')
                ->exports([
                    StudentOrganizationsExport::class
                ]),
        ];
    }
} 