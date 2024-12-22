<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Models\Announcement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationGroup = 'Informasi';
    protected static ?string $navigationLabel = 'Pengumuman';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul'),
                Forms\Components\Select::make('type')
                    ->options([
                        'akademik' => 'Akademik',
                        'non-akademik' => 'Non-Akademik',
                        'kegiatan' => 'Kegiatan',
                        'lomba' => 'Lomba',
                        'beasiswa' => 'Beasiswa',
                        'penting' => 'Penting',
                        'darurat' => 'Darurat',
                    ])
                    ->required(),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('target_audience')
                    ->multiple()
                    ->options([
                        'siswa' => 'Siswa',
                        'guru' => 'Guru',
                        'staff' => 'Staff',
                        'orang_tua' => 'Orang Tua',
                        'umum' => 'Umum',
                    ])
                    ->required(),
                Forms\Components\DateTimePicker::make('publish_date')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date'),
                Forms\Components\Select::make('author_id')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\FileUpload::make('attachments')
                    ->multiple()
                    ->directory('announcements'),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Tampilkan di Highlight'),
                Forms\Components\Toggle::make('is_urgent')
                    ->label('Penting & Mendesak'),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'scheduled' => 'Terjadwal',
                        'published' => 'Dipublikasi',
                        'archived' => 'Diarsipkan',
                    ])
                    ->required(),
                Forms\Components\Select::make('approver_id')
                    ->relationship('approver', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\TagsInput::make('tags'),
                Forms\Components\KeyValue::make('meta')
                    ->label('Informasi Tambahan'),
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
                Tables\Columns\TextColumn::make('author.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('publish_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_urgent')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'scheduled' => 'warning',
                        'published' => 'success',
                        'archived' => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type'),
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\TernaryFilter::make('is_featured'),
                Tables\Filters\TernaryFilter::make('is_urgent'),
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'view' => Pages\ViewAnnouncement::route('/{record}'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
} 