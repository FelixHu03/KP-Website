<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataOrangTuaResource\Pages;
use App\Models\DataOrangTua;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class DataOrangTuaResource extends Resource
{
    protected static ?string $model = DataOrangTua::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Data Orang Tua';

    protected static ?string $modelLabel = 'Data Orang Tua';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // --- BAGIAN 1: HUBUNGKAN DENGAN AKUN USER ---
                Section::make('Informasi Akun')
                    ->schema([
                        Select::make('user_ppdb_id')
                            ->relationship('user', 'name')
                            ->label('Akun Orang Tua')
                            ->searchable()
                            ->required(),

                        TextInput::make('nik_keluarga')
                            ->label('Nomor KK (Kartu Keluarga)')
                            ->required()
                            ->maxLength(16),
                    ])->columns(2),

                // --- BAGIAN 2: DATA AYAH ---
                Section::make('Data Ayah')
                    ->description('Informasi lengkap mengenai Ayah')
                    ->schema([
                        TextInput::make('nama_ayah')->label('Nama Ayah')->required(),
                        TextInput::make('nik_ayah')->label('NIK Ayah')->maxLength(16),
                        DatePicker::make('tanggallahir_ayah')->label('Tanggal Lahir'),
                        TextInput::make('pendidikan_ayah')->label('Pendidikan Terakhir'),
                        TextInput::make('pekerjaan_ayah')->label('Pekerjaan'),
                        TextInput::make('penghasilan_ayah')->label('Penghasilan Bulanan')->numeric(),
                        TextInput::make('hp_ayah')->label('No. HP Ayah')->tel(),
                    ])->columns(2), // Tampilkan 2 kolom per baris

                // --- BAGIAN 3: DATA IBU ---
                Section::make('Data Ibu')
                    ->description('Informasi lengkap mengenai Ibu')
                    ->schema([
                        TextInput::make('nama_ibu')->label('Nama Ibu')->required(),
                        TextInput::make('nik_ibu')->label('NIK Ibu')->maxLength(16),
                        DatePicker::make('tanggallahir_ibu')->label('Tanggal Lahir'),
                        TextInput::make('pendidikan_ibu')->label('Pendidikan Terakhir'),
                        TextInput::make('pekerjaan_ibu')->label('Pekerjaan'),
                        TextInput::make('penghasilan_ibu')->label('Penghasilan Bulanan')->numeric(),
                        TextInput::make('hp_ibu')->label('No. HP Ibu')->tel(),
                    ])->columns(2),

                // --- BAGIAN 4: ALAMAT & LAINNYA ---
                Section::make('Alamat & Informasi Tambahan')
                    ->schema([
                        TextInput::make('alamat')
                            ->label('Alamat Lengkap')
                            ->columnSpanFull(),

                        TextInput::make('sumber_informasi')
                            ->label('Tahu sekolah dari mana?'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->with(['user']))

            ->columns([
                // Menampilkan nama akun UserPpdb pemilik data ini
                TextColumn::make('user.nama_lengkap')
                    ->label('Akun Pendaftar')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nik_keluarga')
                    ->label('No. KK')
                    ->searchable(),

                TextColumn::make('nama_ayah')
                    ->label('Nama Ayah')
                    ->searchable(),

                TextColumn::make('nama_ibu')
                    ->label('Nama Ibu')
                    ->searchable(),

                TextColumn::make('hp_ayah')
                    ->label('No HP Ayah'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Anda bisa menambahkan filter di sini nanti
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataOrangTuas::route('/'),
            'create' => Pages\CreateDataOrangTua::route('/create'),
            'edit' => Pages\EditDataOrangTua::route('/{record}/edit'),
        ];
    }
}
