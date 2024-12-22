<?php

namespace App\Filament\Resources\PrayerAttendanceResource\Pages;

use App\Filament\Resources\PrayerAttendanceResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePrayerAttendance extends CreateRecord
{
    protected static string $resource = PrayerAttendanceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['check_in'] = now();
        $data['status'] = 'present';
        
        return $data;
    }
} 