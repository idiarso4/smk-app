<?php

namespace App\Filament\Resources\ProductionUnitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';
    protected static ?string $title = 'Transaksi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('invoice_number')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('No. Invoice'),
                Forms\Components\Select::make('customer_type')
                    ->options([
                        'student' => 'Siswa',
                        'teacher' => 'Guru',
                        'staff' => 'Staff',
                        'guest' => 'Tamu',
                    ])
                    ->required()
                    ->live()
                    ->label('Tipe Pelanggan'),
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Pelanggan'),
                Forms\Components\Select::make('staff_id')
                    ->relationship('staff', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Petugas'),
                Forms\Components\DateTimePicker::make('transaction_date')
                    ->required()
                    ->default(now())
                    ->label('Tanggal Transaksi'),
                Forms\Components\Repeater::make('items')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->options([
                                'product' => 'Produk',
                                'service' => 'Jasa',
                            ])
                            ->required()
                            ->live()
                            ->label('Tipe'),
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->visible(fn (Forms\Get $get) => $get('type') === 'product')
                            ->label('Produk'),
                        Forms\Components\Select::make('service_id')
                            ->relationship('service', 'name')
                            ->searchable()
                            ->preload()
                            ->visible(fn (Forms\Get $get) => $get('type') === 'service')
                            ->label('Jasa'),
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->label('Jumlah'),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('Rp')
                            ->label('Harga'),
                        Forms\Components\TextInput::make('discount')
                            ->numeric()
                            ->prefix('Rp')
                            ->label('Diskon'),
                        Forms\Components\Textarea::make('notes')
                            ->maxLength(255)
                            ->label('Catatan'),
                    ])
                    ->columns(2)
                    ->required()
                    ->label('Item Transaksi'),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'cash' => 'Tunai',
                        'transfer' => 'Transfer',
                        'qris' => 'QRIS',
                        'other' => 'Lainnya',
                    ])
                    ->required()
                    ->label('Metode Pembayaran'),
                Forms\Components\TextInput::make('total_amount')
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled()
                    ->label('Total'),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Lunas',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->required()
                    ->default('pending')
                    ->label('Status'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(1000)
                    ->label('Catatan'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->searchable()
                    ->sortable()
                    ->label('No. Invoice'),
                Tables\Columns\TextColumn::make('customer.name')
                    ->searchable()
                    ->label('Pelanggan'),
                Tables\Columns\TextColumn::make('transaction_date')
                    ->dateTime()
                    ->sortable()
                    ->label('Tanggal'),
                Tables\Columns\TextColumn::make('total_amount')
                    ->money('idr')
                    ->sortable()
                    ->label('Total'),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->label('Pembayaran'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->label('Status'),
                Tables\Columns\TextColumn::make('staff.name')
                    ->searchable()
                    ->label('Petugas'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status'),
                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Pembayaran'),
                Tables\Filters\DateFilter::make('transaction_date')
                    ->label('Tanggal'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
            ->defaultSort('transaction_date', 'desc');
    }
} 