<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Prestasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category')
                    ->options([
                        'akademik' => 'Akademik',
                        'non-akademik' => 'Non-Akademik',
                        'olahraga' => 'Olahraga',
                        'seni' => 'Seni',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\Select::make('level')
                    ->options([
                        'sekolah' => 'Sekolah',
                        'kota' => 'Kota/Kabupaten',
                        'provinsi' => 'Provinsi',
                        'nasional' => 'Nasional',
                        'internasional' => 'Internasional',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('competition_name')
                    ->required(),
                Forms\Components\TextInput::make('organizer')
                    ->required(),
                Forms\Components\DatePicker::make('achievement_date')
                    ->required(),
                Forms\Components\Select::make('rank')
                    ->options([
                        'juara_1' => 'Juara 1',
                        'juara_2' => 'Juara 2',
                        'juara_3' => 'Juara 3',
                        'harapan_1' => 'Harapan 1',
                        'harapan_2' => 'Harapan 2',
                        'harapan_3' => 'Harapan 3',
                        'finalis' => 'Finalis',
                        'peserta' => 'Peserta',
                    ])
                    ->required(),
                Forms\Components\Select::make('coach_id')
                    ->relationship('coach', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Pembimbing'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('certificate')
                    ->image()
                    ->directory('achievements/certificates'),
                Forms\Components\FileUpload::make('photos')
                    ->multiple()
                    ->image()
                    ->directory('achievements/photos'),
                Forms\Components\FileUpload::make('medal_photo')
                    ->image()
                    ->directory('achievements/medals'),
                Forms\Components\KeyValue::make('news_links')
                    ->label('Link Berita'),
                Forms\Components\TextInput::make('points')
                    ->numeric()
                    ->label('Poin Prestasi'),
                Forms\Components\Select::make('team')
                    ->multiple()
                    ->relationship('team', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Anggota Tim'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge(),
                Tables\Columns\TextColumn::make('level')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sekolah' => 'gray',
                        'kota' => 'info',
                        'provinsi' => 'warning',
                        'nasional' => 'success',
                        'internasional' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('rank')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'juara_1' => 'success',
                        'juara_2' => 'warning',
                        'juara_3' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('achievement_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('points')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category'),
                Tables\Filters\SelectFilter::make('level'),
                Tables\Filters\SelectFilter::make('rank'),
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
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'view' => Pages\ViewAchievement::route('/{record}'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
} 