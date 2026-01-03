<?php

namespace App\Filament\Pages;

use App\Models\TahunAjaran;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static ?string $title = 'Dashboard Utama'; 

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('tahun_ajaran')
                            ->label('Filter Tahun Ajaran')
                            ->options(TahunAjaran::query()->pluck('tahun', 'tahun'))
                            ->default(TahunAjaran::latest()->value('tahun'))
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(3),
            ]);
    }
}