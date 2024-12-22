<?php

namespace App\Filament\Resources\ExamResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ParticipantsRelationManager extends RelationManager
{
    protected static string $relationship = 'participants';
    protected static ?string $title = 'Peserta Ujian';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Siswa'),
                Forms\Components\DateTimePicker::make('start_time')
                    ->label('Waktu Mulai'),
                Forms\Components\DateTimePicker::make('end_time')
                    ->label('Waktu Selesai'),
                Forms\Components\TextInput::make('score')
                    ->numeric()
                    ->suffix('poin')
                    ->label('Nilai'),
                Forms\Components\Select::make('status')
                    ->options([
                        'not_started' => 'Belum Mulai',
                        'in_progress' => 'Sedang Mengerjakan',
                        'completed' => 'Selesai',
                        'abandoned' => 'Dibatalkan',
                    ])
                    ->required()
                    ->label('Status'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable()
                    ->label('Siswa'),
                Tables\Columns\TextColumn::make('student.class.name')
                    ->searchable()
                    ->label('Kelas'),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->label('Mulai'),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime()
                    ->label('Selesai'),
                Tables\Columns\TextColumn::make('score')
                    ->numeric()
                    ->sortable()
                    ->suffix(' poin')
                    ->label('Nilai'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'not_started' => 'gray',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        'abandoned' => 'danger',
                    })
                    ->label('Status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status'),
                Tables\Filters\SelectFilter::make('student.class_id')
                    ->relationship('student.class', 'name')
                    ->label('Kelas'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\ImportAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
} 