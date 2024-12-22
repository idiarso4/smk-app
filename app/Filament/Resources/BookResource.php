<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Perpustakaan';
    protected static ?string $navigationLabel = 'Buku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Buku'),
                Forms\Components\TextInput::make('isbn')
                    ->required()
                    ->unique(ignoreRecord: true)
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
                Forms\Components\Select::make('category')
                    ->options([
                        'fiction' => 'Fiksi',
                        'non-fiction' => 'Non-Fiksi',
                        'textbook' => 'Buku Pelajaran',
                        'reference' => 'Referensi',
                        'magazine' => 'Majalah',
                        'other' => 'Lainnya',
                    ])
                    ->required()
                    ->label('Kategori'),
                Forms\Components\TextInput::make('publication_year')
                    ->numeric()
                    ->required()
                    ->label('Tahun Terbit'),
                Forms\Components\TextInput::make('edition')
                    ->maxLength(50)
                    ->label('Edisi'),
                Forms\Components\TextInput::make('pages')
                    ->numeric()
                    ->label('Jumlah Halaman'),
                Forms\Components\TextInput::make('stock')
                    ->numeric()
                    ->required()
                    ->default(1)
                    ->label('Stok'),
                Forms\Components\TextInput::make('shelf_location')
                    ->required()
                    ->maxLength(50)
                    ->label('Lokasi Rak'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->label('Deskripsi'),
                Forms\Components\FileUpload::make('cover')
                    ->image()
                    ->directory('book-covers')
                    ->label('Sampul Buku'),
                Forms\Components\Toggle::make('is_available')
                    ->required()
                    ->default(true)
                    ->label('Tersedia'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->label('Sampul'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Judul'),
                Tables\Columns\TextColumn::make('isbn')
                    ->searchable()
                    ->label('ISBN'),
                Tables\Columns\TextColumn::make('author')
                    ->searchable()
                    ->label('Penulis'),
                Tables\Columns\TextColumn::make('publisher')
                    ->searchable()
                    ->label('Penerbit'),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('publication_year')
                    ->sortable()
                    ->label('Tahun'),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable()
                    ->label('Stok'),
                Tables\Columns\TextColumn::make('shelf_location')
                    ->searchable()
                    ->label('Lokasi'),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->label('Tersedia'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori'),
                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('Tersedia'),
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
            RelationManagers\LoansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'view' => Pages\ViewBook::route('/{record}'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
} 