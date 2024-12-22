<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrayerAttendanceResource\Pages;
use App\Models\PrayerAttendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrayerAttendanceResource extends Resource
{
    protected static ?string $model = PrayerAttendance::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Keagamaan';
    protected static ?string $navigationLabel = 'Absensi Shalat';

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
                    ->required()
                    ->label('Siswa'),
                Forms\Components\Select::make('class_id')
                    ->relationship('class', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Kelas'),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->default(now())
                    ->label('Tanggal'),
                Forms\Components\Select::make('prayer')
                    ->options([
                        'dzuhur' => 'Dzuhur',
                        'ashar' => 'Ashar',
                        'dhuha' => 'Dhuha',
                        'jumat' => "Jum'at",
                    ])
                    ->default('dzuhur')
                    ->required()
                    ->label('Shalat'),
                Forms\Components\TimePicker::make('check_in')
                    ->required()
                    ->default(now())
                    ->label('Waktu Absen'),
                Forms\Components\Select::make('location')
                    ->options([
                        'masjid' => 'Masjid',
                        'mushola' => 'Mushola',
                        'kelas' => 'Ruang Kelas',
                        'aula' => 'Aula',
                    ])
                    ->required()
                    ->label('Lokasi'),
                Forms\Components\Select::make('status')
                    ->options([
                        'present' => 'Hadir',
                        'late' => 'Terlambat',
                        'permission' => 'Izin',
                        'sick' => 'Sakit',
                        'absent' => 'Tidak Hadir',
                    ])
                    ->required()
                    ->default('present')
                    ->label('Status'),
                Forms\Components\Select::make('supervisor_id')
                    ->relationship('supervisor', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Pembimbing'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable()
                    ->label('Siswa'),
                Tables\Columns\TextColumn::make('class.name')
                    ->searchable()
                    ->sortable()
                    ->label('Kelas'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('prayer')
                    ->badge()
                    ->label('Shalat'),
                Tables\Columns\TextColumn::make('check_in')
                    ->time()
                    ->sortable()
                    ->label('Waktu'),
                Tables\Columns\TextColumn::make('location')
                    ->badge()
                    ->label('Lokasi'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'present' => 'success',
                        'late' => 'warning',
                        'permission' => 'info',
                        'sick' => 'warning',
                        'absent' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('supervisor.name')
                    ->searchable()
                    ->label('Pembimbing'),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('prayer')
                    ->label('Shalat'),
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\SelectFilter::make('location')
                    ->label('Lokasi'),
                Tables\Filters\SelectFilter::make('class_id')
                    ->relationship('class', 'name')
                    ->label('Kelas'),
                Tables\Filters\DateFilter::make('date'),
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
            'index' => Pages\ListPrayerAttendances::route('/'),
            'create' => Pages\CreatePrayerAttendance::route('/create'),
            'view' => Pages\ViewPrayerAttendance::route('/{record}'),
            'edit' => Pages\EditPrayerAttendance::route('/{record}/edit'),
        ];
    }
} 