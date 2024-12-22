<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExtracurricularResource\Pages;
use App\Filament\Resources\ExtracurricularResource\RelationManagers;
use App\Models\Extracurricular;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExtracurricularResource extends Resource
{
    protected static ?string $model = Extracurricular::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Ekstrakurikuler';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama'),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(50)
                    ->label('Kode'),
                Forms\Components\Select::make('category')
                    ->options([
                        'olahraga' => 'Olahraga',
                        'seni' => 'Seni',
                        'akademik' => 'Akademik',
                        'keagamaan' => 'Keagamaan',
                        'teknologi' => 'Teknologi',
                        'sosial' => 'Sosial',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                Forms\Components\Select::make('coach_id')
                    ->relationship('coach', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Pembina'),
                Forms\Components\Select::make('assistant_coach_id')
                    ->relationship('assistantCoach', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Asisten Pembina'),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->label('Lokasi'),
                Forms\Components\Select::make('schedule_day')
                    ->options([
                        'senin' => 'Senin',
                        'selasa' => 'Selasa',
                        'rabu' => 'Rabu',
                        'kamis' => 'Kamis',
                        'jumat' => 'Jumat',
                        'sabtu' => 'Sabtu',
                        'minggu' => 'Minggu',
                    ])
                    ->required(),
                Forms\Components\TimePicker::make('start_time')
                    ->required()
                    ->label('Waktu Mulai'),
                Forms\Components\TimePicker::make('end_time')
                    ->required()
                    ->label('Waktu Selesai'),
                Forms\Components\TextInput::make('quota')
                    ->numeric()
                    ->label('Kuota'),
                Forms\Components\TextInput::make('points')
                    ->numeric()
                    ->label('Poin'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->label('Deskripsi'),
                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->directory('extracurriculars/photos'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif'),
                Forms\Components\Select::make('requirements')
                    ->multiple()
                    ->options([
                        'surat_izin' => 'Surat Izin Orang Tua',
                        'sehat' => 'Surat Keterangan Sehat',
                        'minat_bakat' => 'Tes Minat Bakat',
                        'wawancara' => 'Wawancara',
                        'praktik' => 'Tes Praktik',
                    ])
                    ->label('Persyaratan'),
                Forms\Components\KeyValue::make('facilities')
                    ->label('Fasilitas'),
                Forms\Components\KeyValue::make('achievements')
                    ->label('Prestasi'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge(),
                Tables\Columns\TextColumn::make('coach.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('schedule_day')
                    ->badge(),
                Tables\Columns\TextColumn::make('start_time')
                    ->time(),
                Tables\Columns\TextColumn::make('end_time')
                    ->time(),
                Tables\Columns\TextColumn::make('quota')
                    ->numeric(),
                Tables\Columns\TextColumn::make('members_count')
                    ->counts('members')
                    ->label('Anggota'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category'),
                Tables\Filters\SelectFilter::make('schedule_day'),
                Tables\Filters\TernaryFilter::make('is_active'),
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
            RelationManagers\MembersRelationManager::class,
            RelationManagers\SchedulesRelationManager::class,
            RelationManagers\AttendancesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExtracurriculars::route('/'),
            'create' => Pages\CreateExtracurricular::route('/create'),
            'view' => Pages\ViewExtracurricular::route('/{record}'),
            'edit' => Pages\EditExtracurricular::route('/{record}/edit'),
        ];
    }
} 