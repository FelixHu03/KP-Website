<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalonSiswaResource\Pages;
use App\Models\CalonSiswa;
use App\Filament\Resources\DataOrangTuaResource;
use BcMath\Number;
use Carbon\Carbon;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Tables\Filters\SelectFilter;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;

class CalonSiswaResource extends Resource
{
    protected static ?string $model = CalonSiswa::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Data Calon Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // --- BAGIAN 1: DATA UTAMA ---
                Section::make('Data Pendaftaran')
                    ->schema([
                        TextInput::make('nik')->label('NIK')->required()->maxLength(16),
                        TextInput::make('namalengkap')->label('Nama Lengkap')->required(),
                        Select::make('jenjang_dipilih')
                            ->label('Jenjang')
                            ->options(['TK' => 'TK', 'SD' => 'SD', 'SMP' => 'SMP'])
                            ->required(),
                        TextInput::make('tahun_ajaran')->label('Tahun Ajaran')->required()->default('2025-2026'),
                        TextInput::make('nisn')->label('NISN')->maxLength(10),
                    ])->columns(2),
                // Di dalam schema form()
                Select::make('status')
                    ->label('Status Penerimaan')
                    ->options([
                        'Sedang Diproses' => 'Sedang Diproses',
                        'Lulus' => 'Lulus',
                        'Tidak Lulus' => 'Tidak Lulus',
                    ])
                    ->required()
                    ->native(false),
                Section::make('Data Pribadi')
                    ->schema([
                        TextInput::make('tempatlahir')->label('Tempat Lahir'),
                        DatePicker::make('tanggallahir')->label('Tanggal Lahir'),
                        Select::make('jenis_kelamin')->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']),
                        TextInput::make('handphone')->label('No HP')->tel(),
                        Select::make('vegetarian')->label('Apakah Vegetarian?')->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),
                        Select::make('gelombang')->options([
                            'Gelombang 1' => 'Gelombang 1',
                            'Gelombang 2' => 'Gelombang 2',
                            'Gelombang 3' => 'Gelombang 3',
                        ]),
                    ])->columns(2),

                // GAMBAR AKTA
                Section::make('Dokumen Siswa')
                    ->schema([
                        Repeater::make('dokumen')
                            ->relationship()
                            ->schema([
                                TextInput::make('jenis_dokumen')
                                    ->label('Jenis Dokumen')
                                    ->disabled()
                                    ->formatStateUsing(fn(string $state): string => str($state)->replace('_', ' ')->title()),

                                FileUpload::make('path_penyimpanan')
                                    ->label('File / Gambar')
                                    ->disk('public')
                                    ->acceptedFileTypes(['image/*', 'application/pdf']) // Gunakan ini agar PDF juga bisa masuk/tampil
                                    ->openable()
                                    ->downloadable()
                                    ->deletable(false)
                                    ->columnSpanFull(),
                            ])
                            ->addable(false)
                            ->deletable(false)
                            ->grid(2)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(fn(CalonSiswa $record): string => Pages\EditCalonSiswa::getUrl([$record->id]))

            ->modifyQueryUsing(fn($query) => $query->with(['dokumen', 'user.dataOrangTua']))
            ->columns([
                TextColumn::make('user.nama_lengkap')
                    ->label('Orang Tua')
                    ->searchable()
                    ->sortable()
                    ->color('primary')
                    ->weight('bold')
                    ->url(function ($record) {
                        $dataOrangTua = $record->user->dataOrangTua ?? null;
                        return $dataOrangTua ? DataOrangTuaResource::getUrl('edit', ['record' => $dataOrangTua->id]) : null;
                    }, true), // true = open tab baru

                TextColumn::make('namalengkap')->label('Nama Siswa')->searchable()->sortable(),
                TextColumn::make('nik')->label('NIK')->searchable(),
                TextColumn::make('jenjang_dipilih')->label('Jenjang')->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'TK' => 'warning',
                        'SD' => 'success',
                        'SMP' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->label('Tanggal Daftar')->dateTime('d M Y'),
                // Di dalam columns table()
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Sedang Diproses' => 'warning',
                        'Lulus' => 'success',           
                        'Tidak Lulus' => 'danger',      
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenjang_dipilih')->options(['TK' => 'TK', 'SD' => 'SD', 'SMP' => 'SMP']),
            ])
            ->headerActions([
                ExportAction::make()->label('Export Semua Data')
                    ->exports([
                        ExcelExport::make()
                            ->withFilename('Data_Lengkap_Calon_Siswa_' . date('Y-m-d'))
                            ->withColumns([
                                Column::make('namalengkap')->heading('Nama Lengkap'),

                                Column::make('jenjang_dipilih')->heading('Jenjang Sekolah'),

                                Column::make('tanggallahir')
                                    ->heading('Tanggal Lahir')
                                    ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d-m-Y')),

                                Column::make('tahun_ajaran')->heading('Tahun Ajaran'),

                                Column::make('nik')->heading('NIK')->format(NumberFormat::FORMAT_NUMBER_0),

                                Column::make('vegetarian')->heading('Vegetarian'),

                                Column::make('handphone')->heading('Nomor Handphone'),

                                Column::make('asalsekolah')->heading('Asal Sekolah'),

                                Column::make('nisn')->heading('NISN'),


                                Column::make('nilai_ijazah')->heading('Nilai Ijazah'),
                            ])
                    ]),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()->label('Export Yang Dipilih'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCalonSiswas::route('/'),
            'create' => Pages\CreateCalonSiswa::route('/create'),
            'edit' => Pages\EditCalonSiswa::route('/{record}/edit'),
        ];
    }
}
