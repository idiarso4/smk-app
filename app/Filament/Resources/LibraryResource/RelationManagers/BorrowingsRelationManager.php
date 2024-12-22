<?php

namespace App\Filament\Resources\LibraryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class BorrowingsRelationManager extends RelationManager
{
    protected static string $relationship = 'borrowings';
    protected static ?string $title = 'Peminjaman';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('borrow_date')
                    ->required()
                    ->label('Tanggal Pinjam'),
                Forms\Components\DatePicker::make('due_date')
                    ->required()
                    ->label('Tanggal Kembali'),
                Forms\Components\DatePicker::make('return_date')
                    ->label('Tanggal Dikembalikan'),
                Forms\Components\Select::make('status')
                    ->options([
                        'borrowed' => 'Dipinjam',
                        'returned' => 'Dikembalikan',
                        'overdue' => 'Terlambat',
                        'lost' => 'Hilang',
                        'damaged' => 'Rusak',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('fine_amount')
                    ->numeric()
                    ->label('Denda'),
                Forms\Components\Toggle::make('fine_paid')
                    ->label('Denda Dibayar'),
                Forms\Components\Textarea::make('notes')
                    ->label('Catatan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('borrow_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_date')
                    ->date(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'borrowed' => 'warning',
                        'returned' => 'success',
                        'overdue' => 'danger',
                        'lost' => 'danger',
                        'damaged' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('fine_amount')
                    ->money('idr'),
                Tables\Columns\IconColumn::make('fine_paid')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\TernaryFilter::make('fine_paid'),
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