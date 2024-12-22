<?php

namespace App\Filament\Resources\PrayerAttendanceResource\Pages;

use App\Filament\Resources\PrayerAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPrayerAttendance extends ViewRecord
{
    protected static string $resource = PrayerAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 