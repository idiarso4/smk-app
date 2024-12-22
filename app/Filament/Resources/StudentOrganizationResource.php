<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentOrganizationResource\Pages;
use App\Filament\Resources\StudentOrganizationResource\RelationManagers;
use App\Models\StudentOrganization;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentOrganizationResource extends Resource
{
    protected static ?string $model = StudentOrganization::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Organisasi Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Select::make('type')
                    ->options([
                        'organisasi' => 'Organisasi',
                        'ekstrakurikuler' => 'Ekstrakurikuler',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('vision')
                    ->label('Visi')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('mission')
                    ->label('Misi')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('period_start')
                    ->required(),
                Forms\Components\DatePicker::make('period_end')
                    ->required(),
                Forms\Components\Select::make('advisor_id')
                    ->relationship('advisor', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Pembina'),
                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->directory('organizations'),
                Forms\Components\Toggle::make('status')
                    ->required()
                    ->default(true)
                    ->label('Aktif'),
                Forms\Components\KeyValue::make('social_media')
                    ->label('Media Sosial'),
                Forms\Components\KeyValue::make('contact_info')
                    ->label('Kontak'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('advisor.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('period_start')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('period_end')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type'),
                Tables\Filters\TernaryFilter::make('status'),
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
            RelationManagers\MembersRelationManager::class,
            RelationManagers\ActivitiesRelationManager::class,
            RelationManagers\MeetingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudentOrganizations::route('/'),
            'create' => Pages\CreateStudentOrganization::route('/create'),
            'view' => Pages\ViewStudentOrganization::route('/{record}'),
            'edit' => Pages\EditStudentOrganization::route('/{record}/edit'),
        ];
    }
} 