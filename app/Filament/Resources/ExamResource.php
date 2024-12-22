<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Ujian CBT';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Ujian'),
                Forms\Components\Select::make('exam_type')
                    ->options([
                        'uts' => 'UTS',
                        'uas' => 'UAS',
                        'quiz' => 'Quiz',
                        'daily' => 'Ulangan Harian',
                        'practice' => 'Praktik',
                        'other' => 'Lainnya',
                    ])
                    ->required()
                    ->label('Jenis Ujian'),
                Forms\Components\Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Mata Pelajaran'),
                Forms\Components\Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Guru'),
                Forms\Components\Select::make('classes')
                    ->relationship('classes', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Kelas'),
                Forms\Components\DateTimePicker::make('start_time')
                    ->required()
                    ->label('Waktu Mulai'),
                Forms\Components\DateTimePicker::make('end_time')
                    ->required()
                    ->label('Waktu Selesai'),
                Forms\Components\TextInput::make('duration')
                    ->numeric()
                    ->required()
                    ->suffix('menit')
                    ->label('Durasi'),
                Forms\Components\TextInput::make('passing_grade')
                    ->numeric()
                    ->required()
                    ->suffix('poin')
                    ->label('KKM'),
                Forms\Components\Toggle::make('randomize_questions')
                    ->label('Acak Soal')
                    ->default(true),
                Forms\Components\Toggle::make('show_result')
                    ->label('Tampilkan Hasil')
                    ->default(true),
                Forms\Components\Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
                Forms\Components\RichEditor::make('instructions')
                    ->columnSpanFull()
                    ->label('Petunjuk Ujian'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Judul Ujian'),
                Tables\Columns\TextColumn::make('exam_type')
                    ->badge()
                    ->label('Jenis'),
                Tables\Columns\TextColumn::make('subject.name')
                    ->searchable()
                    ->label('Mata Pelajaran'),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->searchable()
                    ->label('Guru'),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable()
                    ->label('Mulai'),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime()
                    ->sortable()
                    ->label('Selesai'),
                Tables\Columns\TextColumn::make('duration')
                    ->suffix(' menit')
                    ->label('Durasi'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Status'),
                Tables\Columns\TextColumn::make('participants_count')
                    ->counts('participants')
                    ->label('Peserta'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('exam_type')
                    ->label('Jenis Ujian'),
                Tables\Filters\SelectFilter::make('subject_id')
                    ->relationship('subject', 'name')
                    ->label('Mata Pelajaran'),
                Tables\Filters\SelectFilter::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->label('Guru'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
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
            RelationManagers\QuestionsRelationManager::class,
            RelationManagers\ParticipantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'view' => Pages\ViewExam::route('/{record}'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
} 