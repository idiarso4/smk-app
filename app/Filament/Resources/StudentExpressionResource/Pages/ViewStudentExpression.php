<?php

namespace App\Filament\Resources\StudentExpressionResource\Pages;

use App\Filament\Resources\StudentExpressionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentExpression extends ViewRecord
{
    protected static string $resource = StudentExpressionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 