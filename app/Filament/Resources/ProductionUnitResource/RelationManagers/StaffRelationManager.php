<?php

namespace App\Filament\Resources\ProductionUnitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class StaffRelationManager extends RelationManager
{
    protected static string $relationship = 'staff';
    protected static ?string $title = 'Staff';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('staff_id')
                    ->relationship('staff', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Staff'),
                Forms\Components\Select::make('role')
                    ->options([
                        'manager' => 'Manager',
                        'supervisor' => 'Supervisor',
                        'cashier' => 'Kasir',
                        'operator' => 'Operator',
                        'helper' => 'Helper',
                    ])
                    ->required()
                    ->label('Jabatan'),
                Forms\Components\Select::make('shift')
                    ->options([
                        'morning' => 'Pagi',
                        'afternoon' => 'Siang',
                        'evening' => 'Sore',
                        'full' => 'Full Time',
                    ])
                    ->required()
                    ->label('Shift'),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Status Aktif'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('staff.name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->label('Jabatan'),
                Tables\Columns\TextColumn::make('shift')
                    ->badge()
                    ->label('Shift'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Jabatan'),
                Tables\Filters\SelectFilter::make('shift')
                    ->label('Shift'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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