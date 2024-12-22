<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeachingJournalResource\Pages;
use App\Models\TeachingJournal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeachingJournalResource extends Resource
{
    protected static ?string $model = TeachingJournal::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Pembelajaran';
    protected static ?string $navigationLabel = 'Jurnal Mengajar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('teacher_attendance_id')
                    ->relationship('teacherAttendance', 'id')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Data Kehadiran'),
                Forms\Components\Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Guru'),
                Forms\Components\Select::make('class_id')
                    ->relationship('class', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Kelas'),
                Forms\Components\Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Mata Pelajaran'),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('Tanggal'),
                Forms\Components\TimePicker::make('start_time')
                    ->required()
                    ->label('Waktu Mulai'),
                Forms\Components\TimePicker::make('end_time')
                    ->required()
                    ->label('Waktu Selesai'),
                Forms\Components\TextInput::make('topic')
                    ->required()
                    ->maxLength(255)
                    ->label('Topik/Materi'),
                Forms\Components\Select::make('teaching_method')
                    ->options([
                        'ceramah' => 'Ceramah',
                        'diskusi' => 'Diskusi',
                        'praktik' => 'Praktik',
                        'presentasi' => 'Presentasi',
                        'project' => 'Project Based',
                        'problem' => 'Problem Based',
                        'inquiry' => 'Inquiry',
                        'discovery' => 'Discovery',
                        'blended' => 'Blended Learning',
                        'other' => 'Lainnya',
                    ])
                    ->required()
                    ->label('Metode Pembelajaran'),
                Forms\Components\Textarea::make('learning_objectives')
                    ->required()
                    ->label('Tujuan Pembelajaran'),
                Forms\Components\Textarea::make('learning_activities')
                    ->required()
                    ->label('Kegiatan Pembelajaran'),
                Forms\Components\Textarea::make('assessment_method')
                    ->required()
                    ->label('Metode Penilaian'),
                Forms\Components\Select::make('learning_media')
                    ->multiple()
                    ->options([
                        'papan_tulis' => 'Papan Tulis',
                        'proyektor' => 'Proyektor',
                        'video' => 'Video',
                        'audio' => 'Audio',
                        'modul' => 'Modul',
                        'alat_peraga' => 'Alat Peraga',
                        'komputer' => 'Komputer/Laptop',
                        'internet' => 'Internet',
                        'other' => 'Lainnya',
                    ])
                    ->label('Media Pembelajaran'),
                Forms\Components\Textarea::make('homework')
                    ->label('Tugas/PR'),
                Forms\Components\Textarea::make('notes')
                    ->label('Catatan Tambahan'),
                Forms\Components\FileUpload::make('attachments')
                    ->multiple()
                    ->directory('teaching-journals')
                    ->label('Lampiran'),
                // Bagian Kehadiran Siswa
                Forms\Components\Repeater::make('student_attendance')
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->relationship('student', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Siswa'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'hadir' => 'Hadir',
                                'izin' => 'Izin',
                                'sakit' => 'Sakit',
                                'alpha' => 'Alpha',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan'),
                    ])
                    ->label('Kehadiran Siswa')
                    ->defaultItems(0)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('teacher.name')
                    ->searchable()
                    ->sortable()
                    ->label('Guru'),
                Tables\Columns\TextColumn::make('class.name')
                    ->searchable()
                    ->sortable()
                    ->label('Kelas'),
                Tables\Columns\TextColumn::make('subject.name')
                    ->searchable()
                    ->sortable()
                    ->label('Mata Pelajaran'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('topic')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('teaching_method')
                    ->badge(),
                Tables\Columns\TextColumn::make('student_attendance_count')
                    ->counts('studentAttendance')
                    ->label('Jumlah Siswa'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->label('Guru'),
                Tables\Filters\SelectFilter::make('class_id')
                    ->relationship('class', 'name')
                    ->label('Kelas'),
                Tables\Filters\SelectFilter::make('subject_id')
                    ->relationship('subject', 'name')
                    ->label('Mata Pelajaran'),
                Tables\Filters\SelectFilter::make('teaching_method')
                    ->label('Metode Pembelajaran'),
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
            'index' => Pages\ListTeachingJournals::route('/'),
            'create' => Pages\CreateTeachingJournal::route('/create'),
            'view' => Pages\ViewTeachingJournal::route('/{record}'),
            'edit' => Pages\EditTeachingJournal::route('/{record}/edit'),
        ];
    }
} 