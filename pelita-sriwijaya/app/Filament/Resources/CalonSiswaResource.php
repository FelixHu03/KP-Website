<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalonSiswaResource\Pages;
use App\Models\CalonSiswa;
use App\Filament\Resources\DataOrangTuaResource;
use App\Models\Gelombang;
use App\Models\TahunAjaran;
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
use Filament\Forms\Get;
use Filament\Forms\Set;

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
                    TextInput::make('nik')->label('NIK')->required()->numeric()->minLength(16)->maxLength(16),
                    TextInput::make('namalengkap')->label('Nama Lengkap')->required(),
                    
                    Select::make('jenjang_dipilih')
                        ->label('Jenjang')
                        ->options(['TK' => 'TK', 'SD' => 'SD', 'SMP' => 'SMP'])
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Set $set) {
                             $set('nisn', null); $set('asalsekolah', null); $set('nilai_ijazah', null);
                        }),

                    Select::make('tahun_ajaran')
                        ->options(TahunAjaran::query()->pluck('tahun', 'tahun'))
                        ->required(),

                    // Smart Select Gelombang (Kode sebelumnya)
                    Select::make('gelombang_id')
                        ->relationship('gelombang', 'nama_gelombang')
                        ->default(fn () => Gelombang::where('is_active', true)->first()?->id)
                        ->disabled(fn (string $operation) => $operation === 'edit')
                        ->dehydrated()
                        ->required(),

                    Select::make('status')
                        ->options(['Sedang Diproses' => 'Sedang Diproses', 'Lulus' => 'Lulus', 'Tidak Lulus' => 'Tidak Lulus'])
                        ->default('Sedang Diproses')
                        ->required(),
                ])->columns(2),

            // --- BAGIAN 2: DATA PRIBADI ---
            Section::make('Data Pribadi')
                ->schema([
                    TextInput::make('tempatlahir')->required(),
                    DatePicker::make('tanggallahir')->required(),
                    Select::make('jenis_kelamin')->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])->required(),
                    TextInput::make('handphone')->tel()->required(),
                    Select::make('vegetarian')->options(['Ya' => 'Ya', 'Tidak' => 'Tidak'])->required(),
                ])->columns(2),

            // --- BAGIAN 3: DATA KHUSUS (CONDITIONAL) ---
            Section::make('Data Akademik')
                ->schema([
                    TextInput::make('asalsekolah')->visible(fn (Get $get) => $get('jenjang_dipilih') !== 'TK' && $get('jenjang_dipilih') !== null),
                    TextInput::make('nisn')->label('NISN (10)')->numeric()->length(10)->visible(fn (Get $get) => $get('jenjang_dipilih') === 'SMP'),
                    TextInput::make('nilai_ijazah')->numeric()->visible(fn (Get $get) => $get('jenjang_dipilih') === 'SMP'),
                ])
                ->visible(fn (Get $get) => $get('jenjang_dipilih') !== 'TK' && $get('jenjang_dipilih') !== null),

            // --- BAGIAN 4: DOKUMEN (AKTA & RAPORT) ---
            Section::make('Upload Dokumen')
                ->description('Silakan upload Akta Kelahiran atau Dokumen lain di sini.')
                ->schema([
                    Repeater::make('dokumen')
                        ->relationship() 
                        ->label('Daftar Dokumen')
                        ->schema([
                            
                            // 1. Pilih Jenis Dokumen (Agar admin bisa menentukan ini Akta atau Raport)
                            Select::make('jenis_dokumen')
                                ->label('Jenis Dokumen')
                                ->options([
                                    'akta_kelahiran' => 'Akta Kelahiran',
                                    'kartu_keluarga' => 'Kartu Keluarga',
                                    'foto_raport' => 'Foto Raport (Khusus SMP)',
                                    'lainnya' => 'Lainnya',
                                ])
                                ->required()
                                ->formatStateUsing(fn(?string $state): string => $state ?? ''),

                            // 2. Upload Filenya
                            FileUpload::make('path_penyimpanan')
                                ->label('File')
                                ->disk('public') // Pastikan disk public sudah disetting
                                ->directory('dokumen-ppdb') // Folder penyimpanan
                                ->acceptedFileTypes(['image/*', 'application/pdf'])
                                ->openable()
                                ->downloadable()
                                ->required()
                                ->columnSpanFull(),
                        ])
                        ->grid(2)
                        // FITUR TAMBAH DIAKTIFKAN KEMBALI
                        ->addActionLabel('Tambah Dokumen Baru')
                        ->defaultItems(1) // Saat create baru, langsung muncul 1 kotak kosong
                        ->reorderable(false)
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
                SelectFilter::make('tahun_ajaran')->label('Tahun Ajaran')
                    ->options(TahunAjaran::query()->pluck('tahun', 'tahun')),
                SelectFilter::make('gelombang_id')->label('gelombang')
                    ->options(Gelombang::query()->pluck('nama_gelombang', 'id')),
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
