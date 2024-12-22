<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CounselingResource\Pages;
use App\Models\Counseling;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CounselingResource extends Resource
{
    protected static ?string $model = Counseling::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Bimbingan Konseling';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('counselor_id')
                    ->relationship('counselor', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'akademik' => 'Akademik',
                        'karir' => 'Karir',
                        'pribadi' => 'Pribadi',
                        'sosial' => 'Sosial',
                        'keluarga' => 'Keluarga',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\DateTimePicker::make('session_date')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->required(),
                Forms\Components\Select::make('method')
                    ->options([
                        'tatap_muka' => 'Tatap Muka',
                        'online' => 'Online',
                        'telepon' => 'Telepon',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('problem_description')
                    ->required()
                    ->label('Deskripsi Masalah')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('discussion')
                    ->label('Pembahasan')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('solution')
                    ->label('Solusi/Saran')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('follow_up')
                    ->label('Tindak Lanjut')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'scheduled' => 'Terjadwal',
                        'in_progress' => 'Sedang Berlangsung',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        'need_follow_up' => 'Perlu Tindak Lanjut',
                    ])
                    ->required(),
                Forms\Components\Toggle::make('is_confidential')
                    ->label('Rahasia'),
                Forms\Components\Toggle::make('parent_involved')
                    ->label('Melibatkan Orang Tua'),
                Forms\Components\FileUpload::make('attachments')
                    ->multiple()
                    ->directory('counseling')
                    ->label('Lampiran'),
                Forms\Components\KeyValue::make('action_items')
                    ->label('Rencana Tindakan'),
                Forms\Components\Textarea::make('notes')
                    ->label('Catatan')
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
                Tables\Columns\TextColumn::make('counselor.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('session_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('method')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'warning',
                        'in_progress' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'need_follow_up' => 'warning',
                    }),
                Tables\Columns\IconColumn::make('is_confidential')
                    ->boolean(),
                Tables\Columns\IconColumn::make('parent_involved')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type'),
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\SelectFilter::make('method'),
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
            'index' => Pages\ListCounselings::route('/'),
            'create' => Pages\CreateCounseling::route('/create'),
            'view' => Pages\ViewCounseling::route('/{record}'),
            'edit' => Pages\EditCounseling::route('/{record}/edit'),
        ];
    }
} 