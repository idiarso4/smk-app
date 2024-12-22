<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentPermitResource\Pages;
use App\Models\StudentPermit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentPermitResource extends Resource
{
    protected static ?string $model = StudentPermit::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Surat Izin Siswa';
    protected static ?string $slug = 'student-permits';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Siswa')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label('Jenis Izin')
                    ->options([
                        'sick' => 'Sakit',
                        'permission' => 'Izin',
                        'other' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->label('Alasan')
                    ->required(),
                Forms\Components\FileUpload::make('attachment')
                    ->label('Lampiran')
                    ->directory('permits'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis Izin')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sick' => 'danger',
                        'permission' => 'warning',
                        'other' => 'info',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'sick' => 'Sakit',
                        'permission' => 'Izin',
                        'other' => 'Lainnya',
                    }),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Alasan')
                    ->limit(30),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('student_id')
                    ->label('Siswa')
                    ->relationship('student', 'name'),
                Tables\Filters\SelectFilter::make('type')
                    ->label('Jenis Izin')
                    ->options([
                        'sick' => 'Sakit',
                        'permission' => 'Izin',
                        'other' => 'Lainnya',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListStudentPermits::route('/'),
            'create' => Pages\CreateStudentPermit::route('/create'),
            'edit' => Pages\EditStudentPermit::route('/{record}/edit'),
        ];
    }
} 