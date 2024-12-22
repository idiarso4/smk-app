<?php

namespace App\Filament\Resources\LaboratoryResource\Pages;

use App\Filament\Resources\LaboratoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLaboratory extends CreateRecord
{
    protected static string $resource = LaboratoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 