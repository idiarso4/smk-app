<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibraryVisitResource\Pages;
use App\Models\LibraryVisit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LibraryVisitResource extends Resource
{
    protected static ?string $model = LibraryVisit::class;
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Perpustakaan';
    protected static ?string $navigationLabel = 'Kunjungan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('barcode')
                    ->label('Scan Barcode')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->autofocus(),
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\DateTimePicker::make('check_in')
                    ->required()
                    ->label('Waktu Masuk'),
                Forms\Components\DateTimePicker::make('check_out')
                    ->label('Waktu Keluar'),
                Forms\Components\Select::make('purpose')
                    ->options([
                        'reading' => 'Membaca',
                        'borrowing' => 'Meminjam',
                        'returning' => 'Mengembalikan',
                        'studying' => 'Belajar',
                        'research' => 'Penelitian',
                        'other' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label('Catatan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('check_in')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_out')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->badge(),
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
                Tables\Filters\SelectFilter::make('student_id')
                    ->relationship('student', 'name')
                    ->label('Siswa'),
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
            'index' => Pages\ListLibraryVisits::route('/'),
            'create' => Pages\CreateLibraryVisit::route('/create'),
            'view' => Pages\ViewLibraryVisit::route('/{record}'),
            'edit' => Pages\EditLibraryVisit::route('/{record}/edit'),
        ];
    }
} 