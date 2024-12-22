<?php

namespace App\Filament\Resources\StudentOrganizationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';
    protected static ?string $title = 'Anggota';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('position')
                    ->options([
                        'ketua' => 'Ketua',
                        'wakil' => 'Wakil Ketua',
                        'sekretaris' => 'Sekretaris',
                        'bendahara' => 'Bendahara',
                        'koordinator' => 'Koordinator',
                        'anggota' => 'Anggota',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('department')
                    ->label('Bidang/Seksi'),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\TextInput::make('election_votes')
                    ->numeric()
                    ->label('Jumlah Suara'),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'alumni' => 'Alumni',
                    ])
                    ->required(),
                Forms\Components\KeyValue::make('responsibilities')
                    ->label('Tanggung Jawab'),
                Forms\Components\KeyValue::make('achievements')
                    ->label('Prestasi'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->badge(),
                Tables\Columns\TextColumn::make('department'),
                Tables\Columns\TextColumn::make('start_date')
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'alumni' => 'info',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('position'),
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