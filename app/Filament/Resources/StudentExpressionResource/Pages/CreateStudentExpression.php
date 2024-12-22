<?php

namespace App\Filament\Resources\StudentExpressionResource\Pages;

use App\Filament\Resources\StudentExpressionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStudentExpression extends CreateRecord
{
    protected static string $resource = StudentExpressionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'draft';
        
        return $data;
    }
} 