<?php

namespace App\Filament\Resources\StudentExpressionResource\Pages;

use App\Filament\Resources\StudentExpressionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudentExpression extends EditRecord
{
    protected static string $resource = StudentExpressionResource::class;

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