<?php

namespace App\Filament\Resources\ExamResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';
    protected static ?string $title = 'Soal Ujian';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('question_type')
                    ->options([
                        'multiple_choice' => 'Pilihan Ganda',
                        'essay' => 'Essay',
                        'true_false' => 'Benar/Salah',
                        'matching' => 'Menjodohkan',
                        'short_answer' => 'Isian Singkat',
                    ])
                    ->required()
                    ->live()
                    ->label('Jenis Soal'),
                Forms\Components\RichEditor::make('question_text')
                    ->required()
                    ->label('Teks Soal'),
                Forms\Components\FileUpload::make('attachments')
                    ->multiple()
                    ->directory('exam-questions')
                    ->label('Lampiran'),
                Forms\Components\TextInput::make('points')
                    ->numeric()
                    ->required()
                    ->default(1)
                    ->label('Poin'),
                // Pilihan untuk Multiple Choice
                Forms\Components\Repeater::make('choices')
                    ->schema([
                        Forms\Components\TextInput::make('text')
                            ->required()
                            ->label('Teks Pilihan'),
                        Forms\Components\Toggle::make('is_correct')
                            ->label('Jawaban Benar'),
                    ])
                    ->columns(2)
                    ->visible(fn (Forms\Get $get) => $get('question_type') === 'multiple_choice')
                    ->label('Pilihan Jawaban'),
                // Jawaban untuk True/False
                Forms\Components\Toggle::make('correct_answer_boolean')
                    ->visible(fn (Forms\Get $get) => $get('question_type') === 'true_false')
                    ->label('Jawaban Benar'),
                // Jawaban untuk Essay dan Short Answer
                Forms\Components\Textarea::make('answer_key')
                    ->visible(fn (Forms\Get $get) => in_array($get('question_type'), ['essay', 'short_answer']))
                    ->label('Kunci Jawaban'),
                // Matching pairs
                Forms\Components\Repeater::make('matching_pairs')
                    ->schema([
                        Forms\Components\TextInput::make('premise')
                            ->required()
                            ->label('Pernyataan'),
                        Forms\Components\TextInput::make('response')
                            ->required()
                            ->label('Jawaban'),
                    ])
                    ->visible(fn (Forms\Get $get) => $get('question_type') === 'matching')
                    ->label('Pasangan Jawaban'),
                Forms\Components\Select::make('difficulty')
                    ->options([
                        'easy' => 'Mudah',
                        'medium' => 'Sedang',
                        'hard' => 'Sulit',
                    ])
                    ->required()
                    ->label('Tingkat Kesulitan'),
                Forms\Components\Textarea::make('explanation')
                    ->label('Penjelasan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question_type')
                    ->badge()
                    ->label('Jenis'),
                Tables\Columns\TextColumn::make('question_text')
                    ->html()
                    ->limit(50)
                    ->searchable()
                    ->label('Soal'),
                Tables\Columns\TextColumn::make('points')
                    ->numeric()
                    ->sortable()
                    ->label('Poin'),
                Tables\Columns\TextColumn::make('difficulty')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'easy' => 'success',
                        'medium' => 'warning',
                        'hard' => 'danger',
                    })
                    ->label('Kesulitan'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('question_type')
                    ->label('Jenis Soal'),
                Tables\Filters\SelectFilter::make('difficulty')
                    ->label('Tingkat Kesulitan'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\ImportAction::make(),
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
            ])
            ->defaultSort('created_at', 'desc');
    }
} 