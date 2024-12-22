<?php

namespace App\Filament\Resources\ProductionUnitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';
    protected static ?string $title = 'Produk';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Produk'),
                Forms\Components\TextInput::make('sku')
                    ->required()
                    ->maxLength(50)
                    ->label('SKU'),
                Forms\Components\Select::make('category')
                    ->options([
                        'food' => 'Makanan',
                        'beverage' => 'Minuman',
                        'snack' => 'Snack',
                        'stationary' => 'ATK',
                        'uniform' => 'Seragam',
                        'other' => 'Lainnya',
                    ])
                    ->required()
                    ->label('Kategori'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Harga'),
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('Stok'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->label('Deskripsi'),
                Forms\Components\Toggle::make('is_available')
                    ->required()
                    ->default(true)
                    ->label('Tersedia'),
                Forms\Components\FileUpload::make('photos')
                    ->multiple()
                    ->directory('products')
                    ->label('Foto'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Produk'),
                Tables\Columns\TextColumn::make('sku')
                    ->searchable()
                    ->label('SKU'),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('price')
                    ->money('idr')
                    ->sortable()
                    ->label('Harga'),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable()
                    ->label('Stok'),
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\ImportAction::make(),
                Tables\Actions\ExportAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
} 