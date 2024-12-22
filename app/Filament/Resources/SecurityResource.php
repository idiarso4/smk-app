<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SecurityResource\Pages;
use App\Models\Security;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SecurityResource extends Resource
{
    protected static ?string $model = Security::class;
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'Keamanan';
    protected static ?string $navigationLabel = 'Keamanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'terlambat' => 'Terlambat',
                        'bolos' => 'Bolos',
                        'keluar' => 'Keluar Sekolah',
                        'kendaraan' => 'Pelanggaran Kendaraan',
                        'seragam' => 'Pelanggaran Seragam',
                        'atribut' => 'Pelanggaran Atribut',
                        'rambut' => 'Pelanggaran Rambut',
                        'gadget' => 'Pelanggaran Gadget',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\DateTimePicker::make('incident_date')
                    ->required()
                    ->label('Tanggal Kejadian'),
                Forms\Components\TextInput::make('location')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('reported_by')
                    ->relationship('reporter', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('handled_by')
                    ->relationship('handler', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('points')
                    ->numeric()
                    ->label('Poin Pelanggaran'),
                Forms\Components\Select::make('status')
                    ->options([
                        'reported' => 'Dilaporkan',
                        'processing' => 'Diproses',
                        'resolved' => 'Selesai',
                        'escalated' => 'Dieskalasi',
                    ])
                    ->required(),
                Forms\Components\Select::make('action_taken')
                    ->options([
                        'peringatan' => 'Peringatan',
                        'pembinaan' => 'Pembinaan',
                        'sanksi' => 'Sanksi',
                        'panggilan_ortu' => 'Panggilan Orang Tua',
                        'skorsing' => 'Skorsing',
                    ]),
                Forms\Components\Textarea::make('action_notes')
                    ->label('Catatan Tindakan')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('evidence')
                    ->multiple()
                    ->directory('security/evidence')
                    ->label('Bukti'),
                Forms\Components\Toggle::make('parent_notified')
                    ->label('Orang Tua Diberitahu'),
                Forms\Components\DateTimePicker::make('parent_notification_date')
                    ->label('Tanggal Pemberitahuan'),
                Forms\Components\KeyValue::make('parent_response')
                    ->label('Respon Orang Tua'),
                Forms\Components\Textarea::make('follow_up')
                    ->label('Tindak Lanjut')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('incident_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reporter.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('points')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'reported' => 'warning',
                        'processing' => 'info',
                        'resolved' => 'success',
                        'escalated' => 'danger',
                    }),
                Tables\Columns\IconColumn::make('parent_notified')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type'),
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\TernaryFilter::make('parent_notified'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSecurities::route('/'),
            'create' => Pages\CreateSecurity::route('/create'),
            'view' => Pages\ViewSecurity::route('/{record}'),
            'edit' => Pages\EditSecurity::route('/{record}/edit'),
        ];
    }
} 