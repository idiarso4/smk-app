<?php

namespace App\Filament\Resources\BookResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class LoansRelationManager extends RelationManager
{
    protected static string $relationship = 'loans';
    protected static ?string $title = 'Riwayat Peminjaman';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Siswa'),
                Forms\Components\DatePicker::make('loan_date')
                    ->required()
                    ->default(now())
                    ->label('Tanggal Pinjam'),
                Forms\Components\DatePicker::make('due_date')
                    ->required()
                    ->default(now()->addDays(7))
                    ->label('Tanggal Kembali'),
                Forms\Components\DatePicker::make('return_date')
                    ->label('Tanggal Dikembalikan'),
                Forms\Components\TextInput::make('fine_amount')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Denda'),
                Forms\Components\Select::make('status')
                    ->options([
                        'borrowed' => 'Dipinjam',
                        'returned' => 'Dikembalikan',
                        'overdue' => 'Terlambat',
                        'lost' => 'Hilang',
                    ])
                    ->required()
                    ->default('borrowed')
                    ->label('Status'),
                Forms\Components\Select::make('librarian_id')
                    ->relationship('librarian', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Petugas'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable()
                    ->label('Siswa'),
                Tables\Columns\TextColumn::make('student.class.name')
                    ->searchable()
                    ->label('Kelas'),
                Tables\Columns\TextColumn::make('loan_date')
                    ->date()
                    ->sortable()
                    ->label('Tgl Pinjam'),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable()
                    ->label('Tgl Kembali'),
                Tables\Columns\TextColumn::make('return_date')
                    ->date()
                    ->sortable()
                    ->label('Tgl Dikembalikan'),
                Tables\Columns\TextColumn::make('fine_amount')
                    ->money('idr')
                    ->label('Denda'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'borrowed' => 'info',
                        'returned' => 'success',
                        'overdue' => 'warning',
                        'lost' => 'danger',
                    })
                    ->label('Status'),
                Tables\Columns\TextColumn::make('librarian.name')
                    ->searchable()
                    ->label('Petugas'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status'),
                Tables\Filters\DateFilter::make('loan_date')
                    ->label('Tanggal Pinjam'),
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
            ])
            ->defaultSort('loan_date', 'desc');
    }
} 