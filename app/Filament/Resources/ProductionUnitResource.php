<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductionUnitResource\Pages;
use App\Filament\Resources\ProductionUnitResource\RelationManagers;
use App\Models\ProductionUnit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductionUnitResource extends Resource
{
    protected static ?string $model = ProductionUnit::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup = 'Unit Produksi';
    protected static ?string $navigationLabel = 'Unit Produksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Unit'),
                Forms\Components\Select::make('category')
                    ->options([
                        'jasa' => 'Jasa',
                        'produk' => 'Produk',
                        'hybrid' => 'Jasa & Produk',
                    ])
                    ->required()
                    ->label('Kategori'),
                Forms\Components\Select::make('supervisor_id')
                    ->relationship('supervisor', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Penanggung Jawab'),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255)
                    ->label('Lokasi'),
                Forms\Components\TimePicker::make('open_time')
                    ->required()
                    ->label('Jam Buka'),
                Forms\Components\TimePicker::make('close_time')
                    ->required()
                    ->label('Jam Tutup'),
                Forms\Components\Select::make('operational_days')
                    ->multiple()
                    ->options([
                        'senin' => 'Senin',
                        'selasa' => 'Selasa',
                        'rabu' => 'Rabu',
                        'kamis' => 'Kamis',
                        'jumat' => 'Jumat',
                        'sabtu' => 'Sabtu',
                        'minggu' => 'Minggu',
                    ])
                    ->required()
                    ->label('Hari Operasional'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->label('Deskripsi'),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Status Aktif'),
                Forms\Components\FileUpload::make('photos')
                    ->multiple()
                    ->directory('production-units')
                    ->label('Foto'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Unit'),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('supervisor.name')
                    ->searchable()
                    ->label('Penanggung Jawab'),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->label('Lokasi'),
                Tables\Columns\TextColumn::make('operational_hours')
                    ->state(function ($record): string {
                        return $record->open_time . ' - ' . $record->close_time;
                    })
                    ->label('Jam Operasional'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori'),
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
            RelationManagers\ServicesRelationManager::class,
            RelationManagers\ProductsRelationManager::class,
            RelationManagers\TransactionsRelationManager::class,
            RelationManagers\StaffRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductionUnits::route('/'),
            'create' => Pages\CreateProductionUnit::route('/create'),
            'view' => Pages\ViewProductionUnit::route('/{record}'),
            'edit' => Pages\EditProductionUnit::route('/{record}/edit'),
        ];
    }
} 