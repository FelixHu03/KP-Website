<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\Pages\CreateSlider;
use App\Filament\Resources\SliderResource\Pages\EditSlider;
use App\Filament\Resources\SliderResource\Pages\ListSliders;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Upload Gambar Slider')
                    ->schema([
                        TextInput::make('title')
                            ->label('Keterangan (Opsional)')
                            ->placeholder('Misal: Kegiatan Upacara'),

                        FileUpload::make('gambar')
                            ->label('Gambar Banner')
                            ->image()
                            ->disk('public')
                            ->directory('sliders') 
                            ->required()
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Aktifkan?')
                            ->default(true),
                    ])
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            ImageColumn::make('gambar')
                ->disk('public')
                ->width(200)
                ->height(100),
            
            TextColumn::make('title')
                ->label('Keterangan')
                ->searchable(),

            ToggleColumn::make('is_active')
                ->label('Aktif'),
        ])
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
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
            'index' => ListSliders::route('/'),
            'create' => CreateSlider::route('/create'),
            'edit' => EditSlider::route('/{record}/edit'),
        ];
    }
}
