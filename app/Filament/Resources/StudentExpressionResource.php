<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentExpressionResource\Pages;
use App\Filament\Resources\StudentExpressionResource\RelationManagers;
use App\Models\StudentExpression;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentExpressionResource extends Resource
{
    protected static ?string $model = StudentExpression::class;
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Ruang Ekspresi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'artikel' => 'Artikel',
                        'puisi' => 'Puisi',
                        'cerpen' => 'Cerpen',
                        'lukisan' => 'Lukisan',
                        'foto' => 'Foto',
                        'video' => 'Video',
                        'musik' => 'Musik',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('category')
                    ->maxLength(100),
                Forms\Components\TagsInput::make('tags'),
                Forms\Components\FileUpload::make('attachments')
                    ->multiple()
                    ->directory('expressions')
                    ->acceptedFileTypes(['image/*', 'video/*', 'audio/*', 'application/pdf']),
                Forms\Components\DateTimePicker::make('publish_date'),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'review' => 'Review',
                        'published' => 'Published',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
                Forms\Components\Select::make('reviewer_id')
                    ->relationship('reviewer', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Textarea::make('review_notes'),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Tampilkan di Highlight'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publish_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'review' => 'warning',
                        'published' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('likes_count')
                    ->counts('likes')
                    ->label('Likes'),
                Tables\Columns\TextColumn::make('comments_count')
                    ->counts('comments')
                    ->label('Comments'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type'),
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\TernaryFilter::make('is_featured'),
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
            RelationManagers\CommentsRelationManager::class,
            RelationManagers\LikesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudentExpressions::route('/'),
            'create' => Pages\CreateStudentExpression::route('/create'),
            'view' => Pages\ViewStudentExpression::route('/{record}'),
            'edit' => Pages\EditStudentExpression::route('/{record}/edit'),
        ];
    }
} 