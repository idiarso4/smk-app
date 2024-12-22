<?php

namespace App\Filament\Resources\StudentOrganizationResource\Pages;

use App\Filament\Resources\StudentOrganizationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudentOrganization extends CreateRecord
{
    protected static string $resource = StudentOrganizationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 