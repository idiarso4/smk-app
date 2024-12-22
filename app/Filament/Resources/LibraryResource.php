<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibraryResource\Pages;
use App\Filament\Resources\LibraryResource\RelationManagers;
use App\Models\Library;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LibraryResource extends Resource
{
    protected static ?string $model = Library::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Perpustakaan';
    protected static ?string $navigationLabel = 'Koleksi Buku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul'),
                Forms\Components\TextInput::make('isbn')
                    ->required()
                    ->maxLength(50)
                    ->label('ISBN'),
                Forms\Components\TextInput::make('author')
                    ->required()
                    ->maxLength(255)
                    ->label('Penulis'),
                Forms\Components\TextInput::make('publisher')
                    ->required()
                    ->maxLength(255)
                    ->label('Penerbit'),
                Forms\Components\DatePicker::make('publish_year')
                    ->required()
                    ->label('Tahun Terbit'),
                Forms\Components\Select::make('category')
                    ->options([
                        'umum' => 'Umum',
                        'filsafat' => 'Filsafat',
                        'agama' => 'Agama',
                        'sosial' => 'Sosial',
                        'bahasa' => 'Bahasa',
                        'sains' => 'Sains',
                        'teknologi' => 'Teknologi',
                        'seni' => 'Seni',
                        'sastra' => 'Sastra',
                        'sejarah' => 'Sejarah',
                        'geografi' => 'Geografi',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('edition')
                    ->maxLength(50)
                    ->label('Edisi'),
                Forms\Components\TextInput::make('pages')
                    ->numeric()
                    ->label('Jumlah Halaman'),
                Forms\Components\TextInput::make('rack_location')
                    ->required()
                    ->maxLength(50)
                    ->label('Lokasi Rak'),
                Forms\Components\TextInput::make('copies')
                    ->numeric()
                    ->required()
                    ->label('Jumlah Copy'),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->label('Harga'),
                Forms\Components\FileUpload::make('cover')
                    ->image()
                    ->directory('library/covers'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->label('Deskripsi'),
                Forms\Components\Select::make('status')
                    ->options([
                        'available' => 'Tersedia',
                        'borrowed' => 'Dipinjam',
                        'reserved' => 'Dipesan',
                        'maintenance' => 'Pemeliharaan',
                        'lost' => 'Hilang',
                        'damaged' => 'Rusak',
                    ])
                    ->required(),
                Forms\Components\TagsInput::make('tags')
                    ->separator(','),
                Forms\Components\Select::make('language')
                    ->options([
                        'indonesia' => 'Indonesia',
                        'inggris' => 'Inggris',
                        'arab' => 'Arab',
                        'jepang' => 'Jepang',
                        'mandarin' => 'Mandarin',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\KeyValue::make('additional_info')
                    ->label('Informasi Tambahan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('isbn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge(),
                Tables\Columns\TextColumn::make('rack_location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('copies')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('borrowed_count')
                    ->counts('borrowings')
                    ->label('Dipinjam'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'available' => 'success',
                        'borrowed' => 'warning',
                        'reserved' => 'info',
                        'maintenance' => 'warning',
                        'lost' => 'danger',
                        'damaged' => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category'),
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\SelectFilter::make('language'),
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
            RelationManagers\BorrowingsRelationManager::class,
            RelationManagers\ReservationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLibraries::route('/'),
            'create' => Pages\CreateLibrary::route('/create'),
            'view' => Pages\ViewLibrary::route('/{record}'),
            'edit' => Pages\EditLibrary::route('/{record}/edit'),
        ];
    }
} 