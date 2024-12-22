<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingResource\Pages;
use App\Models\Meeting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MeetingResource extends Resource
{
    protected static ?string $model = Meeting::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Rapat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Guru'),
                Forms\Components\Select::make('class_id')
                    ->relationship('class', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Kelas'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul'),
                Forms\Components\Select::make('type')
                    ->options([
                        'akademik' => 'Akademik',
                        'kedisiplinan' => 'Kedisiplinan',
                        'konseling' => 'Konseling',
                        'orang_tua' => 'Orang Tua',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required()
                    ->label('Tipe'),
                Forms\Components\DateTimePicker::make('start_time')
                    ->required()
                    ->label('Waktu Mulai'),
                Forms\Components\DateTimePicker::make('end_time')
                    ->required()
                    ->label('Waktu Selesai'),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->label('Lokasi'),
                Forms\Components\Select::make('method')
                    ->options([
                        'offline' => 'Offline',
                        'online' => 'Online',
                        'hybrid' => 'Hybrid',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('online_url')
                    ->url()
                    ->label('Link Online'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->label('Deskripsi'),
                Forms\Components\Select::make('participants')
                    ->multiple()
                    ->relationship('attendees', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Peserta'),
                Forms\Components\KeyValue::make('agenda')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('attachments')
                    ->multiple()
                    ->directory('meetings')
                    ->label('Lampiran'),
                Forms\Components\Select::make('status')
                    ->options([
                        'scheduled' => 'Terjadwal',
                        'ongoing' => 'Berlangsung',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull()
                    ->label('Catatan'),
                Forms\Components\KeyValue::make('results')
                    ->columnSpanFull()
                    ->label('Hasil Rapat'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('class.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('method')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'warning',
                        'ongoing' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type'),
                Tables\Filters\SelectFilter::make('method'),
                Tables\Filters\SelectFilter::make('status'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMeetings::route('/'),
            'create' => Pages\CreateMeeting::route('/create'),
            'view' => Pages\ViewMeeting::route('/{record}'),
            'edit' => Pages\EditMeeting::route('/{record}/edit'),
        ];
    }
} 