<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalonSiswaResource\Pages;
use App\Models\CalonSiswa;
use App\Filament\Resources\DataOrangTuaResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section; // Gunakan Section dari Forms
use Filament\Forms\Components\Repeater; // Tambahan untuk dokumen
use Filament\Forms\Components\FileUpload; // Tambahan untuk gambar
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Tables\Filters\SelectFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

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
                    ])->columns(2),

                Section::make('Data Pribadi')
                    ->schema([
                        TextInput::make('tempatlahir')->label('Tempat Lahir'),
                        DatePicker::make('tanggallahir')->label('Tanggal Lahir'),
                        Select::make('jenis_kelamin')->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']),
                        TextInput::make('handphone')->label('No HP')->tel(),
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
                                    // ->image() // Hapus ini jika file bisa berupa PDF
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
                    }, true), // true = open in new tab agar tidak hilang dari list

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
            ])
            ->filters([
                SelectFilter::make('jenjang_dipilih')->options(['TK' => 'TK', 'SD' => 'SD', 'SMP' => 'SMP']),
            ])
            ->headerActions([
                ExportAction::make()->label('Export Semua Data')
                    ->exports([ExcelExport::make()->fromTable()->withFilename('Data_Calon_Siswa')]),
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
