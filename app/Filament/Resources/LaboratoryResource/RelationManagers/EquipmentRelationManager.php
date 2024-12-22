<?php

namespace App\Filament\Resources\LaboratoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class EquipmentRelationManager extends RelationManager
{
    protected static string $relationship = 'equipment';
    protected static ?string $title = 'Peralatan Lab';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'alat' => 'Alat',
                        'bahan' => 'Bahan',
                    ])
                    ->required(),
                Forms\Components\KeyValue::make('specifications')
                    ->label('Spesifikasi'),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('condition')
                    ->options([
                        'baik' => 'Baik',
                        'rusak_ringan' => 'Rusak Ringan',
                        'rusak_berat' => 'Rusak Berat',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('purchase_date')
                    ->label('Tanggal Pembelian'),
                Forms\Components\DatePicker::make('last_maintenance')
                    ->label('Maintenance Terakhir'),
                Forms\Components\DatePicker::make('next_maintenance')
                    ->label('Maintenance Berikutnya'),
                Forms\Components\FileUpload::make('manual_book')
                    ->directory('manuals'),
                Forms\Components\Select::make('status')
                    ->options([
                        'available' => 'Tersedia',
                        'in_use' => 'Sedang Digunakan',
                        'maintenance' => 'Maintenance',
                        'broken' => 'Rusak',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label('Catatan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('condition')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baik' => 'success',
                        'rusak_ringan' => 'warning',
                        'rusak_berat' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type'),
                Tables\Filters\SelectFilter::make('condition'),
                Tables\Filters\SelectFilter::make('status'),
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