<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestBookResource\Pages;
use App\Models\GuestBook;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GuestBookResource extends Resource
{
    protected static ?string $model = GuestBook::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Tamu';
    protected static ?string $navigationLabel = 'Buku Tamu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama'),
                Forms\Components\TextInput::make('institution')
                    ->maxLength(255)
                    ->label('Institusi/Asal'),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(20)
                    ->label('No. Telepon'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Select::make('purpose')
                    ->options([
                        'meeting' => 'Pertemuan',
                        'visit' => 'Kunjungan',
                        'research' => 'Penelitian',
                        'internship' => 'Magang',
                        'collaboration' => 'Kerjasama',
                        'other' => 'Lainnya',
                    ])
                    ->required()
                    ->label('Tujuan'),
                Forms\Components\Select::make('person_to_meet')
                    ->relationship('staff', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Ingin Bertemu'),
                Forms\Components\DateTimePicker::make('check_in')
                    ->required()
                    ->label('Waktu Masuk'),
                Forms\Components\DateTimePicker::make('check_out')
                    ->label('Waktu Keluar'),
                Forms\Components\FileUpload::make('identity_card')
                    ->image()
                    ->directory('guest-book/identity')
                    ->label('Kartu Identitas'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
                Forms\Components\Select::make('status')
                    ->options([
                        'waiting' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'completed' => 'Selesai',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('feedback')
                    ->maxLength(1000)
                    ->label('Umpan Balik'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('institution')
                    ->searchable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->badge(),
                Tables\Columns\TextColumn::make('staff.name')
                    ->label('Bertemu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('check_in')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_out')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'waiting' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'completed' => 'info',
                    }),
                Tables\Columns\TextColumn::make('duration')
                    ->state(function ($record): string {
                        if (!$record->check_out) return '-';
                        $duration = $record->check_out->diffInMinutes($record->check_in);
                        return floor($duration / 60) . ' jam ' . ($duration % 60) . ' menit';
                    }),
            ])
            ->defaultSort('check_in', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('purpose'),
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\SelectFilter::make('person_to_meet')
                    ->relationship('staff', 'name')
                    ->label('Bertemu'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuestBooks::route('/'),
            'create' => Pages\CreateGuestBook::route('/create'),
            'view' => Pages\ViewGuestBook::route('/{record}'),
            'edit' => Pages\EditGuestBook::route('/{record}/edit'),
        ];
    }
} 