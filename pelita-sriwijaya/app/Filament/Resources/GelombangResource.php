<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GelombangResource\Pages;
use App\Filament\Resources\GelombangResource\RelationManagers;
use App\Models\Gelombang;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GelombangResource extends Resource
{
    protected static ?string $model = Gelombang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Info Gelombang')
                    ->schema([
                        TextInput::make('nama_gelombang')
                            ->label('Nama Gelombang')
                            ->placeholder('Contoh: Gelombang 1 (Early Bird)')
                            ->required(),

                        TextInput::make('biaya_pendaftaran')
                            ->label('Biaya Pendaftaran')
                            ->prefix('Rp')
                            ->numeric() // Hanya angka
                            ->default(0)
                            ->required(),

                        Grid::make(2)
                            ->schema([
                                DatePicker::make('tanggal_mulai')
                                    ->label('Tanggal Dibuka')
                                    ->required(),
                                DatePicker::make('tanggal_selesai')
                                    ->label('Tanggal Ditutup')
                                    ->required(),
                            ]),

                        Toggle::make('is_active')
                            ->label('Aktifkan Gelombang Ini?')
                            ->default(true)
                            ->helperText('Jika aktif, sistem akan mengecek tanggalnya.'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_gelombang')->sortable()->searchable(),
                TextColumn::make('tanggal_mulai')->date('d M Y')->sortable(),
                TextColumn::make('tanggal_selesai')->date('d M Y')->sortable(),
                TextColumn::make('biaya_pendaftaran')
                    ->money('IDR', locale: 'id'),
                ToggleColumn::make('is_active')->label('Status Aktif'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListGelombangs::route('/'),
            'create' => Pages\CreateGelombang::route('/create'),
            'edit' => Pages\EditGelombang::route('/{record}/edit'),
        ];
    }
}
