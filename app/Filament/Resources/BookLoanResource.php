<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookLoanResource\Pages;
use App\Models\BookLoan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookLoanResource extends Resource
{
    protected static ?string $model = BookLoan::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Perpustakaan';
    protected static ?string $navigationLabel = 'Peminjaman Buku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Siswa'),
                Forms\Components\Select::make('book_id')
                    ->relationship('book', 'title')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Buku'),
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

    public static function table(Table $table): Table
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
                Tables\Columns\TextColumn::make('book.title')
                    ->searchable()
                    ->label('Buku'),
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
                Tables\Filters\SelectFilter::make('student.class_id')
                    ->relationship('student.class', 'name')
                    ->label('Kelas'),
                Tables\Filters\DateFilter::make('loan_date')
                    ->label('Tanggal Pinjam'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('loan_date', 'desc');
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
            'index' => Pages\ListBookLoans::route('/'),
            'create' => Pages\CreateBookLoan::route('/create'),
            'view' => Pages\ViewBookLoan::route('/{record}'),
            'edit' => Pages\EditBookLoan::route('/{record}/edit'),
        ];
    }
} 